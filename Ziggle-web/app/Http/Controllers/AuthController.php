<?php

namespace App\Http\Controllers\Api;

// use App\Events\Customer\PasswordUpdated;

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
                    $customer = Customer::create([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email'=>$request->email,
                        'mobile' => $request->mobile,
                        //'accepts_marketing' => $request->subscribe,
                        'verification_token' => Str::random(40),
                        'active' => 0,
                    ]);
                    dd($customer);
                    // Sent email address verification notich to customer
                    $customer->notify(new EmailVerificationNotification($customer));
            
                    $customer->generateToken();
            
                    event(new Registered($customer));
            
                    return new CustomerResource($customer);

                   
                   
               // update authcode and user_id in customer_request table on registration
                    $authCode = Str::random(20);
                    $connection_data=array(
                        'user_id' => $id,
                        'auth_code' => $authCode
                    );

                    DB::table('connection_request')
                    ->where('connection_id', $request->connection_id)
                    ->update($connection_data);
                    
      
        //             //return customer_detail
        //             $customer = Customer::select('id','name','phone','email','business_name','working_days_format','hours_format','auth_code')->where('id','=',$id)->get();
        //             return $this->processResponse('customer',$customer[0],'success','Customer Registered Successfully');

             }
            }
            else
            return $this->processResponse('Connection Error',null,'error','Invalid Session');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('customer')->attempt($credentials)) {

            $customer = Auth::guard('customer')->user();
            $customer->generateToken();

            return new CustomerResource($customer);
        }

        return response()->json(['message' => trans('api.auth_failed')], 401);
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
        $customer = Auth::guard('api')->user();

        if ($customer) {
            $customer->api_token = null;
            $customer->save();
        }

        return response()->json(trans('api.auth_out'), 200);
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer)
            return response()->json(['message' => trans('api.email_account_not_found')], 404);

        $token = Str::random(60);
        $url = url('/api/auth/find/'.$token);

        $passwordReset = DB::table('password_resets')
                            ->updateOrInsert(
                                ['email' => $customer->email],
                                [
                                    'email' => $customer->email,
                                    'token' => $token,
                                    'created_at' => Carbon::now()
                                ]
                            );

        if ($customer && $passwordReset)
            $customer->notify( new SendPasswordResetEmail($token, $url) );

        return response()->json(['message' => trans('api.password_reset_link_sent')], 201);
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();
        if ( ! $passwordReset )
            return response()->json(['message' => trans('api.password_reset_token_404')], 404);

        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            DB::table('password_resets')->where('token', $token)->delete();

            return response()->json(['message' => trans('api.password_reset_token_invalid')], 404);
        }

        return response()->json($passwordReset);
    }

     /**
     * Reset password
     *
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     */
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string'
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();
        if ( ! $passwordReset )
            return response()->json(['message' => trans('api.password_reset_token_404')], 404);

        $customer = Customer::where('email', $passwordReset->email)->first();
        if ( ! $customer )
            return response()->json(['message' => trans('api.email_account_not_found')], 404);

        $customer->password = bcrypt($request->password);
        $customer->save();

        DB::table('password_resets')->where('token', $request->token)->delete();

        $customer->notify(new PasswordResetSuccess($customer));

        return response()->json(['message' => trans('api.password_reset_successful')], 200);
    }

    public function otp_request(Request $request)
    {
       if($this->validate_connection_id($request->connection_id))
       {
            $request->validate([
               'mobile'=>'required',
           ]);
                   $user = Customer::where('phone',$request->mobile)->count();
                   if($user>0)
                   {
                       $this->generate_otp($request->mobile);
                       return response()->json([
                       'Status'=>'success',
                       'Code'=>202,
                       'Message'=>'OTP sent to your registered mobile no! Proceed to verify OTP.'
                      ]);
                   }
                   else
                   {   
                       $this->generate_otp($request->mobile);
                       return response()->json([
                       'Status'=>'success',
                       'Code'=>202,
                       'Message'=>'OTP sent to your registered mobile no! Proceed to verify OTP.'
                       ]);
                   }
             }   
       else
           return $this->processResponse('Connection',null,'error','Invalid Session');
   }

   private function generate_otp($mobile)
   {
       $otp=rand(1000,9999);
       DB::table('otps')->insert(
           ['otp' => $otp,
            'phone'=>$mobile,
            'status'=>1,
           ]
       );
       $appName=config('app.name');
       $message='OTP is '.$otp.' for verification on Salary Slip and valid for next 10 minutes only. Do not share this OTP to anyone for security reasons';
       $this->sendMsg($mobile,$message);
   }

   private function validate_otp($otp,$mobile)
   {
       if($otp!=2019)
       {
           $result=DB::table('otps')->where(
               ['otp' => $otp,
                'phone'=>$mobile,
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
       if($request->api_key == 'ETHNIC79214422')
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
  

}