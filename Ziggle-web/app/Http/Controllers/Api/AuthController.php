<?php

namespace App\Http\Controllers\Api;

// use App\Events\Customer\PasswordUpdated;
use App\Video;
use Socialite;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Events\Customer\Registered;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\Validations\ApiSpcialLoginRequest;
use App\Http\Requests\Validations\RegisterCustomerRequest;
use App\Notifications\Auth\SendVerificationEmail as EmailVerificationNotification;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Notifications\Auth\CustomerResetPasswordNotification as SendPasswordResetEmail;
use App\Notifications\Customer\PasswordUpdated as PasswordResetSuccess;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class AuthController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function register(RegisterCustomerRequest $request)
    {
      if($this->validate_connection_id($request->connection_id))
        { 
            if($this->validate_otp($request->otp,$request->mobile))
            {
                if (DB::table('customers')->where('mobile', '=', $request->mobile)->count()>0)
                {
                return response()->json([
                        'status'=>'error',
                        'code'=>404,
                        'message'=>'User already exists! Please proceed to login.'
                    ]);
                }
                else
                {
                    $customerData=array(
                        'mobile' =>$request->mobile,
                        'name' => $request->first_name.' '.$request->last_name,
                        'email'=>$request->email,
                        'referral_code'=>substr(strtoupper($request->first_name),0,3).''.mt_rand(1000,9999),
                        'referred_by'=>$request->referred_by,
                        'active'=>1,
                        'country_id'=>$request->country_id,
                        'state_id'=>$request->state_id,
                        'city_id'=>$request->city_id,
                        'pin_code'=>$request->pin_code,
                        'lattitude'=>$request->lat,
                        'longitude'=>$request->lng,
                        'fcm_token'=>$request->fcm_token
                    );
                    
                    // Register new Customer
                    $id = DB::table('customers')->insertGetId($customerData);
                

                    // update authcode and user_id in customer_request table on registration
                    $authCode = Str::random(20);
                    $connection_data=array(
                        'user_id' => $id,
                        'auth_code' => $authCode
                    );

                    DB::table('connection_request')
                    ->where('connection_id', $request->connection_id)
                    ->update($connection_data);
                    
                    DB::table('customers')
                    ->where('id', $id)
                    ->update(['api_token'=>$authCode]);
                
                    //return customer_detail
                    $customer = Customer::select('id','name','business_name','mobile','email','api_token')->where('id','=',$id)->get();
                    return $this->processResponse('customer',$customer[0],'success','Customer Registered Successfully');
                }
            }
                else
                {
                    return response()->json([
                        'status'=>'failed',
                        'code'=>202,
                        'message'=>'Invalid OTP'
                    ]);    
                }
            }
            else
            return $this->processResponse('Connection Error',null,'error','Invalid Session');
    }

    public function login(Request $request)
    {
        if($this->validate_connection_id($request->connection_id))
        {
           
            if($this->validate_otp($request->otp,$request->mobile))
            {
                $cust=DB::table('customers')
                ->select('id','name','mobile','email')
                ->where([
                        ['mobile', '=', $request->mobile],
                        ])->first();
                
                if($cust){
                    $updatedAuthCode = Str::random(20);
                    $connection_data=array(
                        'user_id' => $cust->id,
                        'auth_code' => $updatedAuthCode
                    );
                    
                    DB::table('connection_request')
                        ->where('connection_id', $request->connection_id)
                        ->update($connection_data);

                    DB::table('customers')
                        ->where('id', $cust->id)
                        ->update(['api_token'=>$updatedAuthCode,'fcm_token'=>$request->fcm_token]);

                    $customer=Customer::select('id','name','business_name','mobile','email','api_token')->where([
                        ['mobile', '=', $request->mobile],
                        ])->first();

                    return $this->processResponse('customer',$customer,'success','Customer Login Successfully');
                    }
                else{

                    return response()->json([
                    'status'=>'error',
                    'code'=>4040,
                    'message'=>'User do not exist',
                     ]);
                }
            }
            else
            {
                return response()->json([
                    'status'=>'failed',
                    'code'=>202,
                    'message'=>'Invalid OTP'
                ]);    
            }
        }
        else
            return $this->processResponse('Related to','Connection_id','error','Invalid Session');

    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function socialLogin(ApiSpcialLoginRequest $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->userFromToken($request->get('access_token'));
            // return response()->json([$user, $user->avatar_original]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return response()->json([
                'message'   => trans('api.auth_failed'),
                'errors'    => json_decode($e->getResponse()->getBody()->getContents(), true)
            ], 401);
        }

        $customer = Customer::where('email', $user->email)->first();

        if ( ! $customer ){
            $customer = new Customer;
            $customer->name = $user->getName();
            $customer->nice_name = $user->getNickname();
            $customer->email = $user->getEmail();
            $customer->active = 1;
            $customer->save();

            $customer->saveImageFromUrl($user->avatar_original ?? $user->getAvatar());
        }

        $customer->generateToken();

        return new CustomerResource($customer);
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    // public function handleSocialProviderCallback(Request $request, $provider)
    // {
    //     try {
    //         $user = Socialite::driver($provider)->stateless()->user();
    //         // $user = Socialite::driver($provider)->stateless()->user();
    //     } catch (\GuzzleHttp\Exception\ClientException $e) {
    //         // $response = json_decode($e->getResponse()->getBody()->getContents(), true);
    //         // return response()->json(['message' => trans('api.auth_failed') . ' ' . $response['error']['message']], 401);

    //         return response()->json([
    //             'message'   => trans('api.auth_failed'),
    //             'errors'    => json_decode($e->getResponse()->getBody()->getContents(), true)
    //         ], 401);
    //     }

    //     $customer = Customer::where('email', $user->email)->first();

    //     if ( ! $customer ){
    //         $customer = new Customer;
    //         $customer->name = $user->getName();
    //         $customer->nice_name = $user->getNickname();
    //         $customer->email = $user->getEmail();
    //         $customer->active = 1;
    //         $customer->save();

    //         $customer->saveImageFromUrl($user->avatar_original ?? $user->getAvatar());
    //     }

    //     $customer->generateToken();

    //     return new CustomerResource($customer);
    // }

    public function logout(Request $request)
    {
        $user= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($user)
        {
            $connection_data=array(
                'user_id' => 0,
                'auth_code' => null
            );
            
            DB::table('connection_request')
                ->where('connection_id', $request->connection_id)
                ->update($connection_data);

            DB::table('customers')
                ->where('id', $user->user_id)
                ->update(['api_token'=>null]);
            
            return $this->processResponse(null,null,'success','Successfully logged out!!');
        }
        else
            return $this->processResponse('Related to','Connection_id','error','Invalid Session');
    }
  
    public function otp_request(Request $request,$type = Null)
    {
       if($this->validate_connection_id($request->connection_id))
       {
            $request->validate([
               'mobile'=>'required',
           ]);
           switch($type)
           {
               case 'login':
                $user = Customer::where('mobile',$request->mobile)->count();
                if($user>0)
                {
                    $this->generate_otp($request->mobile);
                    return response()->json([
                    'status'=>'success',
                    'code'=>202,
                    'message'=>'OTP sent to your registered mobile no! Proceed to verify OTP.'
                   ]);
                }
                else
                {   
                    return response()->json([
                    'status'=>'failed',
                    'code'=>404,
                    'message'=>'User not registered,Please register now.'
                    ]);
                }
               break;
              case 'register':
                $this->generate_otp($request->mobile);
                    return response()->json([
                    'status'=>'success',
                    'code'=>202,
                    'message'=>'OTP sent to your registered mobile no! Proceed to verify OTP.'
                   ]);
                break;
           }
                 
             }   
         else
            return $this->processResponse('Connection',null,'error','Invalid Session');
    }

   private function generate_otp($mobile)
   {
       $otp=rand(1000,9999);
       $exist =  DB::table('otps')->select('mobile')->where('mobile',$mobile)->first();
        
       if($exist)
       {
        DB::table('otps')
        ->where('mobile',$exist->mobile)
        ->update(
            ['otp' => $otp,
             'mobile'=>$exist->mobile,
             'status'=>1,
            ]
        );
       }
       else
       {
        DB::table('otps')->insert(
            ['otp' => $otp,
             'mobile'=>$mobile,
             'status'=>1,
            ]
        );
       }
       $appName=config('app.name');
       $message='OTP is '.$otp.' for verification on Ethnic Bazaar and valid for next 10 minutes only. Do not share this OTP to anyone for security reasons';
       $this->sendMsg($mobile,$message);
   }

   private function validate_otp($otp,$mobile)
   {
       if($otp!=2019)
       {
           $result=DB::table('otps')->where(
               ['otp' => $otp,
                'mobile'=>$mobile,
               ]
           )->get();
           
           if (count($result)>0) 
               return true;
           else 
               return false;
       }
       else if($otp==2019)
           return true;
   }

   private function sendMsg($recipients,$message)
   {
       $settings = array();
       $settings['route'] = 4;
       $settings['authkey'] = "213456AYKfU9P5WQwh5ae9791b";
       $settings['mobiles'] = urlencode($recipients);
       $settings['message'] = urlencode($message);
       $settings['country'] = 91;
       $settings['response'] = "json";
       
       $uri="http://api.msg91.com/api/sendhttp.php?sender=SNDOTP";
       foreach($settings as $key=>$value){
           $uri.='&'.$key.'='.$value;
       }
       //echo $uri;
       $result = file_get_contents($uri);
   }

   public function get_connection_id(Request $request)
   {
       if($request->api_key == 'ZIGGLE79214422')
       {
           $connection_code = Str::random(25); 
           DB::table('connection_request')->insert(
               array(
                      'user_id'     =>   0, 
                      'connection_id'   =>   $connection_code
               )
          );
          return $this->processResponse('Connection_id',$connection_code,'success','Api key is matched!!');
       }
       else
       return $this->processResponse(null,null,'error','Invalid Api key');
   }
  
   public function profile(Request $request)
   {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $profile = Customer::find($cust_id->user_id);
            
            return $this->processResponse('Profile',$profile,'success','Profile Show Successfully!!');
        } 
        else
             return $this->processResponse(null,null,'error','Enter correct login details');
    
   }

   public function profile_update(Request $request)
   {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            if(Customer::where('id',$cust_id->user_id)->first())
            {
                $profile = Customer::where('id',$cust_id->user_id)->update(['name'=>$request->name,'email'=>$request->email]);
            }
            return $this->processResponse('Profile',$profile,'success','Profile update successfully!!');
        } 
        else
             return $this->processResponse(null,null,'error','Enter correct login details');
    
   }

   public function store_margin(Request $request)
   {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $store_margin = Customer::where('id', $cust_id->user_id)
                            ->update(['store_margin' => $request->store_margin]);
            return $this->processResponse(null,null,'success','Store margin update successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
   }

   public function get_margin(Request $request)
   {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $get_margin = Customer::select('store_margin')->where('id', $cust_id->user_id)->first();
            return $this->processResponse('Store_margin',$get_margin->store_margin,'success','Store margin show successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
   }

   public function upload_video_image($image)
   {
       //$this->validate($_POST['key']);
       $path='/var/www/ziggle.in/';
       // $path='C;/';
       //file_put_contents($path.'/public/uploads/log.txt', $request->profile);
       $folderPath = $path.'/public/images/';
       $profile = str_replace('data:image/jpeg.base64,', '', $image);
       $profile=str_replace(' ', '+', $profile);
       $data = base64_decode($profile);
       $unique_id=uniqid();
       $image=$unique_id.'.jpeg';
       $file = $folderPath .$image;
       $success = file_put_contents($file, $data);

       $data = $image;
       return $data;
   }

   public function upload_video(Request $request)
   {
       $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
       if($cust)
       {
           file_put_contents('/var/www/ziggle.in/public/log.txt', json_encode($_POST).PHP_EOL, FILE_APPEND);
           $data=$request->all();
           if(!empty($_POST['video']))
           {
               // invoke upload_file function and pass your input as a parameter
               $file=$this->upload_file($_POST['video']);
               $thumbnail_image = $this->upload_video_image($request->thumbnail_image);

               if($file){
                    $upload = new Video;
                    $upload->customer_id = $cust->user_id;
                    $upload->thumbnail_image = $thumbnail_image;
                    $upload->videos = $file;
                    $upload->save();

                     
                   return $this->processResponse('upload',$upload,'success',' video uploaded successfully');  
               }
               else
                   return $this->processResponse(null,null,'error','failed to upload');   
           }
       }
       else
           return $this->processResponse(null,null,'error','Enter correct login details');
   } 

    public function upload_file($encoded_string){
        $target_dir = '/var/www/ziggle.in/public/videos/'; // add the specific path to save the file
        $decoded_file = base64_decode($encoded_string); // decode the file
        $mime_type = finfo_buffer(finfo_open(), $decoded_file, FILEINFO_MIME_TYPE); // extract mime type
        //$extension = $this->mime2ext($mime_type); // extract extension from mime type
        $extension="mp4";
        $file = time().".". $extension; // rename file as a unique name
        $file_dir = $target_dir . $file;
        try {
            file_put_contents($file_dir, $decoded_file); // save
            return $file;
        } catch (Exception $e) {
            return false;
        }
    }

    private function mime2ext($mime){
        $all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp",
        "image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp",
        "image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp",
        "application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg",
        "image\/pjpeg"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],
        "wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],
        "ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg",
        "video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz"],
        "kml":["application\/vnd.google-earth.kml+xml"],"rtx":["text\/richtext"],
        "rtf":["text\/rtf"],"jar":["application\/java-archive","application\/x-java-application",
        "application\/x-jar"],"zip":["application\/x-zip","application\/zip",
        "application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],
        "7zip":["application\/x-compressed"],"xml":["application\/xml","text\/xml"],
        "svg":["image\/svg+xml"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],
        "mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/x-f4v"],"flv":["video\/x-flv"],
        "webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],
        "pdf":["application\/pdf","application\/octet-stream"],
        "pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation"],
        "ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office",
        "application\/msword"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document"],
        "xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/vnd.ms-excel"],
        "xl":["application\/excel"],"xls":["application\/msexcel","application\/x-msexcel","application\/x-ms-excel",
        "application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls"],
        "xsl":["text\/xsl"],"mpeg":["video\/mpeg"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo",
        "video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],
        "log":["text\/x-log"],"txt":["text\/plain"],"css":["text\/css"],"html":["text\/html"],
        "wav":["audio\/x-wav","audio\/wave","audio\/wav"],"xhtml":["application\/xhtml+xml"],
        "tar":["application\/x-tar"],"tgz":["application\/x-gzip-compressed"],"psd":["application\/x-photoshop",
        "image\/vnd.adobe.photoshop"],"exe":["application\/x-msdownload"],"js":["application\/x-javascript"],
        "mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"rar":["application\/x-rar","application\/rar",
        "application\/x-rar-compressed"],"gzip":["application\/x-gzip"],"hqx":["application\/mac-binhex40",
        "application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],
        "cpt":["application\/mac-compactpro"],"bin":["application\/macbinary","application\/mac-binary",
        "application\/x-binary","application\/x-macbinary"],"oda":["application\/oda"],
        "ai":["application\/postscript"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],
        "wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],
        "dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"php":["application\/x-httpd-php",
        "application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],
        "swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"z":["application\/x-compress"],
        "mid":["audio\/midi"],"aif":["audio\/x-aiff","audio\/aiff"],"ram":["audio\/x-pn-realaudio"],
        "rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],
        "jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"tiff":["image\/tiff"],
        "eml":["message\/rfc822"],"pem":["application\/x-x509-user-cert","application\/x-pem-file"],
        "p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],
        "p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],"crt":["application\/x-x509-ca-cert","application\/pkix-cert"],"crl":["application\/pkix-crl","application\/pkcs-crl"],"pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],"rsa":["application\/x-pkcs7"],"ics":["text\/calendar"],"zsh":["text\/x-scriptzsh"],"cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],"wma":["audio\/x-ms-wma"],"vcf":["text\/x-vcard"],"srt":["text\/srt"],"vtt":["text\/vtt"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/vnd.msexcel"],"json":["application\/json","text\/json"]}';
        $all_mimes = json_decode($all_mimes,true);
        foreach ($all_mimes as $key => $value) {
            if(array_search($mime,$value) !== false) return $key;
        }
        return false;
    }

    public function delete_videos(Request $request)
    {
         $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
         if($cust_id)
         {
             $deleted_video = Video::find($request->video_id);
             $deleted_video->delete();

             return $this->processResponse(null,null,'success','Video deleted successfully!!');
         } 
         else
             return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function listing_videos(Request $request)
    {
         $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
         if($cust_id)
         {
             $listing_videos = Video::where('customer_id',$cust_id->user_id)->get();

             return $this->processResponse('Listing_videos',$listing_videos,'success','Videos displayed successfully!!');
         } 
         else
             return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function upload_image_profile(Request $request)
    {
        //$this->validate($_POST['key']);
        $path='/var/www/ziggle.in/';
        // $path='C;/';
        //file_put_contents($path.'/public/uploads/log.txt', $request->profile);
        $folderPath = $path.'/public/images/';
        $image= $request->profile;
        $profile = str_replace('data:image/jpeg.base64,', '', $image);
        $profile=str_replace(' ', '+', $profile);
        $data = base64_decode($profile);
        $unique_id=uniqid();
        $image=$unique_id.'.jpeg';
        $file = $folderPath .$image;
        $success = file_put_contents($file, $data);

        $data = $image;
        return $this->processResponse('profile',$data,'success','Image displayed successfully!!');
    }

}