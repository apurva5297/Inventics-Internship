<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use App\Inventory;
use App\Customer;
use App\User;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Order;
//validator is builtin class in laravel
use Validator;
use App\Events\Shop\ShopCreated;
use App\Jobs\CreateShopForMerchant;
use DB;
use DateTime;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Repositories\Merchant\MerchantRepository;
//for requesting a value 
use Illuminate\Routing\Controller;
//user Agent
use App\Repositories\User\UserRepository;
use App\Events\User\UserCreated;
use App\Events\User\UserUpdated;
//for Carbon a value 
use Carbon\Carbon;
class Buyerapi extends Controller
{
    protected $url;
    private $merchant;
    private $user;

    public function __construct(UrlGenerator $url,MerchantRepository $merchant,UserRepository $user)
    {
        $this->url = $url;
        $this->merchant = $merchant;
        $this->user = $user;

    }

	public function check_version(Request $request,$version){

			$this->validate($_POST['key']);	
			//echo "hii"; exit();
		/*$version=$_POST['version'];*/
		$version=$version;

	    $result = DB::table('sf_app_version')->where('type', '=', 'buyer')->get();
			
		foreach($result as $row){
	 
			   	if($version < $row->version)
			{
				echo '{"Status":"success", "Message":"Need update", "force_update":'.$row->force_update.', "update_required":1,"Error":"0000"}';
			}
			else{
				echo '{"Status":"success", "Message":"Same version", "force_update":0, "update_required":0,"Error":"0000"}';
			}		

        }
	}

	public function banner(Request $request){

			$this->validate($_POST['key']);	

	    $result = DB::table('slides')->where('status', '=', 'ok')->get();
			
		foreach($result as $row){
	 
	 	echo '{"Status":"success","message":"banner data","error":"000000","data":'.json_encode($row).'}';

        }
	}

	public function category(Request $request){

			$this->validate($_POST['key']);	

	    $result = DB::table('category')->select('category_id','category_name')->get();
			
		/*foreach($result as $row){
	 
	 	echo '{"status":"success","message":"category data","error":"000000","data":'.json_encode($row).'}';

        }*/
        echo '{"Status":"success","message":"category data","error":"000000","data":'.json_encode($result).'}';
	}

	public function subcategory(Request $request){

			$this->validate($_POST['key']);	

	    $result = DB::table('category')
	    		 ->select('data_subdets')
	    		 ->where('category_id', '=',$request->keykey)
	    		 ->get();
			
		foreach($result as $row){
	 
	 	echo '{"Status":"success","message":"sub category data","error":"000000","data":'.$row->data_subdets.'}';
	 	

        }

       
	}

	public function products_by_category(Request $request){	

		$start=$request->page_id*10; // get start index eg for 0 => 0, for 1=>10
    	$this->validate($_POST['key']);	
       // $customer_id =$_POST['customer_id'];

	    $result = DB::table('product')
	    		 ->select('product_id','title','sale_price','unit','discount','current_stock')
	    		 ->where('category', '=',$request->id)
	    		 ->offset(9)
	    		 ->take($start)
	    		 ->get();
			//return $result;
	    echo '{"Status":"success","message":"product list","error":"000000","data":'.json_encode($result).'}';

       
	}

	public function products_by_subcategory(Request $request){	

		$start=$request->page_id*10; // get start index eg for 0 => 0, for 1=>10
    	$this->validate($_POST['key']);	
        //$customer_id =$_POST['customer_id'];

	    $result = DB::table('product')
	    		 ->select('product_id','title','sale_price','unit','discount','current_stock')
	    		 ->where('sub_category', '=',$request->id)
	    		 ->offset(9)
	    		 ->take($start)
	    		 ->get();
			//return $result;

	    echo '{"Status":"success","message":"product list"","error":"000000","data":'.json_encode($result).'}';

       
	}

	public function featured_products(Request $request){	

    	$this->validate($_POST['key']);	
       // $customer_id =$_POST['customer_id'];

	    $result = DB::table('product')
	    		 ->select('product_id','title','sale_price','unit','discount','current_stock')
	    		 ->where('featured', '=','ok') // just for getting different data for now
	    		 ->offset(0)
	    		 ->take(9)
	    		 ->get();
			//return $result;

	    echo '{"Status":"success","message":"featured product list","error":"000000","data":'.json_encode($result).'}';

       
	}

	    public function featured_category($page_id) // send category data as per page id
    {
        $this->validate($_POST['key']);	

        // return title, subtitle and 4 products
  
        $row=DB::table('promo_category')->where(['id'=>$page_id])->get();

        $data['title']=$row[0]->title;
        $data['subtitle']=$row[0]->subtitle;
        $data['color_code']=$row[0]->color_code;
        $product_id=explode(',', $row[0]->products);
        
        $row = Inventory::find($product_id);

         $data['products']=array( 
               'product_id'            =>$row[0]->id,
               'title'                 =>$row[0]->title,
               'sale_price'            =>round($row[0]->sale_price),
               'unit'                  =>'Piece',
               'discount'              =>round($row[0]->offer_price),
               'current_stock'         =>$row[0]->stock_quantity,
               'image'                 =>$row[0]->images,
               'all_data'              =>$row,
        
            );    
        /*$data['products']=DB::table('product')
        					->select('product_id','title','sale_price','unit','discount','current_stock')
        					->whereIn('product_id',$product_id)
        					->get(); */

        echo '{"status":"success","message":"featured product list","error":"000000","data":'.json_encode($data).'}';
    }

        public function featured_brand($page_id) // send brand data as per page id
    {
        $this->validate($_POST['key']);	

        // return title, subtitle and 4 products
  
        $row=DB::table('promo_brand')->where(['id'=>$page_id])->get();

        $data['title']=$row[0]->title;
        $data['subtitle']=$row[0]->subtitle;
        
        $data['image']='http://simpel.in/images/test_img.png';

        $product_id=explode(',', $row[0]->products);
        
 	    $row = Inventory::find($product_id);

         $data['products']=array( 
               'product_id'            =>$row[0]->id,
               'title'                 =>$row[0]->title,
               'sale_price'            =>round($row[0]->sale_price),
               'unit'                  =>'Piece',
               'discount'              =>round($row[0]->offer_price),
               'current_stock'         =>$row[0]->stock_quantity,
               'image'                 =>$row[0]->images,
               'all_data'              =>$row,
        
            ); 

        echo '{"status":"success","message":"featured brand List","error":"000000","data":'.json_encode($data).'}';
    }

	public function new_products(Request $request){	

    	$this->validate($_POST['key']);	
        //$customer_id =$_POST['customer_id'];

	    $result = DB::table('product')
	    		 ->select('product_id','title','sale_price','unit','discount','current_stock')
	    		 ->where(['category'=>4,'deal'=>null]) // just for getting different data for now
	    		 ->offset(0)
	    		 ->take(9)
	    		 ->get();
			//return $result;

	    echo '{"Status":"success","message":"product list","error":"000000","data":'.json_encode($result).'}';

       
	}


	public function products(Request $request){	

    	$this->validate($_POST['key']);	
       // $customer_id =$_POST['customer_id'];

	    $result = DB::table('product')
	    		 ->select('product_id','title','single_pc', 'pack_of_3', 'pack_of_5','sale_price','unit','discount','discount_type','shipping_cost','current_stock','mrp')
	    		->where('product_id', '=',$request->id)
	    		->get();

			$result['margin']= intval(($result[0]->mrp-$result[0]->sale_price)*100/$result[0]->mrp);
		
		echo '{"Status":"success","message":"product data","error":"000000","data":'.json_encode($result).'}';

       
	}

	public function products_by_ids(Request $request){	

		$start=$request->page_id*10; // get start index eg for 0 => 0, for 1=>10
    	$this->validate($_POST['key']);	
        $customer_id =$_POST['customer_id'];
        $ids =$_POST['product'];

	    $result = DB::table('product')
	    		 ->select('product_id','current_stock')
	    		 ->where('product_id', '=',$ids)
	    		 ->limit(9)
	    		 /*->offset($start)*/
	    		 ->get();
			//return $result;
	    echo '{"Status":"success","message":"product list","error":"000000","data":'.json_encode($result).'}';

       
	}
	public function product_description(Request $request){	

    	$this->validate($_POST['key']);	
        $customer_id =$_POST['customer_id'];

	    $result = DB::table('product')
	    		 ->select('description')
	    		->where('product_id', '=',$request->id)
	    		->get();

		return $result;
		//echo '{"status":"success","message":"sub category data","error":"000000","data":'.$result.'}';
  
	}

	public function logout()
    {
        $this->validate($_POST['key']);	
        $user_id =$_POST['user_id'];

		DB::table('customers')->where(['id'=>$user_id])->update(["remember_token"=>""]);
        echo '{"Status":"success", "Message":"Logged Out", "Error":"0000"}';
    }

	public function customer_login(Request $request){	

    	$this->validate($_POST['key']);	
        $phone =$_POST['phone'];
        $token =$_POST['fcm_token'];
        $otp =$_POST['otp'];

	    $user = DB::table('customers')->where('phone', '=',$phone)->get();
	    $marchant = DB::table('users')->where('phone', '=',$phone)->get();
	     if(count($user)>0)
        {
            $this->verify_login_otp($phone,$otp);
            // $this->pac->verify_login_otp($phone_number,$otp);
            DB::table('customers')->where('id', '=',$user[0]->id)->update(["remember_token"=>$token]);
            $user['password']="";
            $user['type']="retailer";
            echo '{"Status":"success", "Message":"Data Validated", "Error":"0000", "user_data":'.json_encode($user[0]).'}';
        }
        else if(count($marchant)>0)
        {
            $this->verify_login_otp($phone,$otp);
            // $this->pac->verify_login_otp($phone_number,$otp);
            DB::table('users')->where('id', '=',$marchant[0]->id)->update(["remember_token"=>$token]);
            $data['id']=$marchant[0]->id;
            $data['shop_id']=$marchant[0]->shop_id;
            $data['role_id']=$marchant[0]->role_id;
            $data['email']=$marchant[0]->email;
            $data['phone']=$marchant[0]->phone;
            $data['name']=$marchant[0]->name;
            $data['password']="";
            $data['type']="Seller";
            $data['remember_token']=$marchant[0]->remember_token;

            echo '{"Status":"success", "Message":" reseller Data Validated", "Error":"0000", "user_data":'.json_encode($data).'}';
        }
        else{
            echo '{"Status":"failed", "Message":"User does not exist", "Error":"1003"}';
        }
		
		//echo '{"status":"success","message":"sub category data","error":"000000","data":'.$result.'}';
  
	}

	 public function request_login_otp($phone)
    {	
    	
        $this->validate($_POST['key']);	
        $user = DB::table('customers')->where(['phone'=>$phone])->get();
	    $agent = DB::table('users')->where(['phone'=>$phone])->get();
    
        if(count($user)>0){
            $row = $user;
        }
        else if(count($agent)>0){
            $row = $agent;
        }

        if(!empty($row)){
            echo $this->generate_otp($phone);
        }
        else{
            echo '{"Status":"failed", "Message":"User Does not exist", "Error":"1003"}';
        }
    }

    public function request_signup_otp($phone)
    {	
    	/*file_put_contents('/var/www/html/log.txt',time().PHP_EOL, FILE_APPEND);
    	file_put_contents('/var/www/html/log.txt',$phone.PHP_EOL, FILE_APPEND);*/

        //$phone =$request->phone;
        $this->validate($_POST['key']);	
        $row= DB::table('customers')->where(['phone'=>$phone])->get();
        if(count($row)>0){
        	//echo json_encode($row);
            echo '{"Status":"failed", "Message":"User already exist", "Error":"1004"}';
            
        }
        else{
             echo $this->generate_otp($phone);
        }
    }

    public function generate_otp($phone) {
		$otp=mt_rand(1000,9999);
		$row=DB::table('otp')->where('phone', '=',$phone)->get();
		if(count($row)>0)
		{	
			//if otp generated 10min ago.. delete and regenerate
			date_default_timezone_set('Asia/Kolkata');
			$datetime1 = new DateTime($row[0]->created_at);
			$datetime2 = new DateTime(date('Y-m-d H:i:s'));
			$interval = $datetime1->diff($datetime2);
			$i=$interval->format('%i');
			
			//echo $interval->format('s');
			
			if($i>=10)
			{	
				DB::table('otp')->where(['phone'=>$phone])->delete();
				DB::table('otp')->insert(['phone'=>$phone,'otp'=>$otp]);
			}
			else 
				$otp=$row[0]->otp; // set old otp to send
		}
		else {	DB::table('otp')->insert(['phone'=>$phone,'otp'=>$otp]); }
				
		$message='OTP:'.$otp.', it will expire in 10 minutes.';
		$this->sendMsg($phone,$message);
		echo '{"Status":"success", "Message":"OTP sent", "Error":"0000"}';
	}

	public function sendMsg($recipients,$message)
	{
		$settings = array();
		$settings['route'] = 4;
		$settings['authkey'] = "226912AppUI8j4akp5b503a45";
		$settings['mobiles'] = urlencode($recipients);
		$settings['message'] = urlencode($message);
		$settings['country'] = 91;
		$settings['response'] = "json";
		
		$uri="http://api.msg91.com/api/sendhttp.php?sender=SIMPEL";
		foreach($settings as $key=>$value){
			$uri.='&'.$key.'='.$value;
		}
		//echo $uri;
		$result = file_get_contents($uri);
	}

	public function verify_login_otp($phone,$otp)
	{		
		$row=DB::table('otp')->where(['phone'=>$phone,'otp'=>$otp])->get();	
		if(count($row)>0)
		{
			DB::table('otp')->where(['phone'=>$phone])->delete();
			return true;
		}
		else {	echo '{"Status":"failed", "Message":"OTP Invalid or Expire", "Error":"10011"}'; exit();}
	}

	public function verify_otp(Request $request, $phone,$otp)
	 {		
		   $row=DB::table('otp')->where(['phone'=>$phone,'otp'=>$otp])->get();	
		
		if(count($row)>0)
	       {	
			$data=DB::table('customers')->where(['phone'=>$phone])->get();	
			$getData=array(
				'Status'=>'SUCCESS',
				'Message'=>'User Data',
				'user_data'=>$data,

			 );
			 DB::table('otp')->where(['phone'=>$phone])->delete();
			
    	  if($request->type=='Seller') {
    		$phone=DB::table('users')->where(['phone'=>$request->phone])->get();
    		$email=DB::table('users')->where(['email'=>$request->email])->get();

    		if(count($phone)>0){
    		
    		     echo '{"Status":"failed", "Message":"User Phone is already exist", "Error":"1005"}'; exit();
               
               } elseif (count($email)>0) {
            	  echo '{"Status":"failed", "Message":"User Email is already exist", "Error":"1005"}'; exit();
                 }else{
            	    $rand=$this->generate_random();
    			    $request['shop_name']=$request->name.'-'.$rand;
    			    $request['nice_name']=$request->name;
    		 	    $merchant = $this->merchant->store($request);
			 	    CreateShopForMerchant::dispatch($merchant, $request->all());
				    event(new ShopCreated($merchant->owns));
				    $merchant['role_id']=3;
				    $merchant['type']='Seller';
				    echo '{"Status":"success", "Message":"merchant registered", "Error":"0000", "user_data":'.json_encode($merchant).'}';
			    exit();
               }
    	    }


    	     if($request->type=='agent') {
    		$phone=DB::table('users')->where(['phone'=>$request->phone])->get();
    		$email=DB::table('users')->where(['email'=>$request->email])->get();

    		if(count($phone)>0){
    		
    		     echo '{"Status":"failed", "Message":"User Phone is already exist", "Error":"1005"}'; exit();
               
               } elseif (count($email)>0) {
            	  echo '{"Status":"failed", "Message":"User Email is already exist", "Error":"1005"}'; exit();
                 }else{
                 	$request['role_id']=6;
                 	$request['nice_name']=$request->name;
                 	$request['password']='$2y$10$cAFFslyUlKrUSjte2z5qPeIsoBZt03s9GrHbiRqrAMw5oNLYesm3G';
            	    $user = $this->user->store($request);
                   event(new UserCreated($user, $request->name, $request->get('password')));
				    $user['type']='agent';
				    echo '{"Status":"success", "Message":"Agent registered", "Error":"0000", "user_data":'.json_encode($user).'}';
			    exit();
               }
    	    }

			  $id=$this->customer_register($_POST);
            if($_POST['type']=="Retailer"){

                $row= DB::table('customers')->where(['id'=>$id])->get();
                $row[0]->type="Retailer";
               }
            else{	
                 $row= DB::table('agent')->where(['user_id'=>$id])->get();
                 $row[0]->type="reseller";
             }

              $row[0]->password="";
              echo '{"Status":"success", "Message":"User registered", "Error":"0000", "user_data":'.json_encode($row[0]).'}';
		}
		   else
		    {
			echo '{"Status":"failed", "Message":"OTP Invalid or Expire", "Error":"10011"}';
		    }
		
		
	}
	

	public function customer_register($data)
    {   
        $name=$data['name'];
        $email=$data['email'];
        $phone=$data['phone'];
        $type=$data['type'];
        $pass=rand(100000,999999);
        $token=$data['fcm_token'];

        if($type=="Retailer"){
            $data= array(
                "name"=>$name,
                "nice_name"=>$name,
                "email"=>$email,
                "active"=>1,
                "phone"=>$phone,
                "remember_token"=>$token,
                "password"=> bcrypt($pass),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
            );

            $row=DB::table('customers')->where('phone', '=',$phone)->get();
        
            if(count($row)>0){
                echo '{"Status":"failed", "Message":"User already exist", "Error":"1005"}'; exit();
            }
            else{
            	$id=DB::table('customers')->insertGetId($data);

            	$addresses=array(
            		'address_type'   =>'Primary',
            		'address_title'	 =>$name,
            		'state_id'		 =>624,
            		'country_id'	 =>356,
            		'addressable_id' =>$id,
            		'phone'			 =>$phone,
            		'addressable_type'=>'App\Customer',
            		"created_at" => Carbon::now()->toDateTimeString(),
                	"updated_at" => Carbon::now()->toDateTimeString(),
            	);
            	 DB::table('addresses')->insert($addresses);
                // give 10000 promo balance
                $tdata=array(
                    "cust_id"=>$id,
                    "amount"=>10000,
                    "amount_after"=>10000,
                    "type"=>"credit",
                    "transaction_id"=>time(),
                    "remark"=>"Promotional",
                    "payment_data"=>""
                );
                DB::table('sf_wallet_transaction')->insert($tdata);
                
                // update balance
                $wdata=array(
                    "cust_id"=>$id,
                    "wallet_amnt"=>10000
                );
                DB::table('sf_wallet')->insert($wdata);

            }
        }
        else if($type=="Reseller"){
             $data= array(
                "username"=>$name,
                "email"=>$email,
                "phone"=>$phone,
                "token"=>$token,
                "reference"=>""
            );
            $row=DB::table('agent')->where('phone', '=',$phone)->get();
    		
            if(count($row)>0){
                echo '{"Status":"failed", "Message":"Reseller already exist", "Error":"1005"}'; exit();
            }
            else{

                $id=$id=DB::table('agent')->insertGetId($data);
    			// update balance
    			$wdata=array(
    				"cust_id"=>$id,
    				"wallet_amnt"=>0
    			);
    			DB::table('sf_wallet')->insert($wdata);
  
            }
        }
        return $id;
    }

     public function wallet_balance()
    {	
    	$this->validate($_POST['key']);
    	$customer_id = $_POST['customer_id'];
    	$row=DB::table('sf_wallet')->where('cust_id', '=',$customer_id)->get();

    	$useges=$row[0]->credit_limit*$row[0]->use/100;
    	
    	
    	if($row[0]->wallet_amnt >=$useges ){

    		$balance_use=$useges;
    		$balance_wallet_amount=$row[0]->wallet_amnt;
    	}else{
    		$balance_use=$row[0]->wallet_amnt;
    		$balance_wallet_amount=$row[0]->wallet_amnt;
    	}
    	
    	echo '{"Status" : "success" , "Message":"available","Error":"0000","Balance_use":"'.$balance_use.'","wallet_balance":"'.$balance_wallet_amount.'"}';
    }

     public function recent_transactions()
    {
    	$this->validate($_POST['key']);
    	$customer_id = $_POST['customer_id'];
    	$row= DB::table('sf_wallet_transaction')->where('cust_id', '=',$customer_id)->orderBy('id', 'DESC')->get();
    	echo '{"Status" : "success" , "Message":"list","Error":"0000","List":'.json_encode($row).'}';
    }

    public function wallet_banner()
    {
    	$this->validate($_POST['key']);
    	$customer_id = $_POST['customer_id'];

    	$row=DB::table('sf_setting')->get();
    	$banner=$row[0]->app_offer;
    	echo '{"Status" : "success" , "Message":"wallet banner","Error":"0000","Banner":"http://simpel.in/'.$banner.'"}';
    }

     public function search(Request $request,$page_id)
    {
        $start=$page_id*10; // get start index eg for 0 => 0, for 1=>10

        $this->validate($_POST['key']);
    	$customer_id = $_POST['customer_id'];
        $term= $_POST['keyword'];
		//find in indexing if exist

		/*$index=DB::table('search_mapping')->where('term', '=',$term)->get();    
		//echo json_encode($index);
		if(sizeof($index)>0)
			$term= $index[0]->glue;*/
		//echo $term;
        $row=DB::table('inventories')
        	->select('id as inventories_id','product_id','title','brand', 'sku', 'condition','set_desc','description','offer_price','sale_price','stock_quantity')
        	->where('title', 'LIKE', '%' . $term . '%')
 			->orWhere('brand', 'LIKE', '%' . $term . '%')
 			->orWhere('sku', 'LIKE', '%' . $term . '%')
 			->orWhere('description', 'LIKE', '%' . $term . '%')
 			->orWhere('slug', 'LIKE', '%' . $term . '%')
 			->orWhere('meta_title', 'LIKE', '%' . $term . '%')
 			->orWhere('meta_description', 'LIKE', '%' . $term . '%')
 			->offset(0)
            ->take($start)
        	->get();
        
        echo '{"Status":"success","message":"product list","error":"000000","data":'.json_encode($row).'}';
    }
	

	public function feed_banner(Request $request){

			$this->validate($_POST['key']);	

		$row['feed_banner']=$this->url->to('/').'/images/fbanner.jpg';
		echo '{"Status":"success","message":"banner data","error":"000000","data":'.json_encode($row).'}';
	}


	public function add_address(Request $request)
	{

        $this->validate($_POST['key']);		
        $customer_id=$_POST['customer_id'];
         $result=DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->get();
        $data=array(
            "address_title" =>$_POST['name'], 
            "email_id"		=>$_POST['email'],  
            "phone"			=>$_POST['mobile'],   
            "address_line_1"=>$_POST['address_line_1'], 
            "address_line_2"=>$_POST['address_line_2'], 
            "city"			=>$_POST['city'],  
            "country_name"	=>$_POST['country'],
            "state_name"	=>$_POST['state'],
            'country_id'	=> 356, 
            "zip_code"		=>$_POST['pincode'],  
            "address_type"	=>$_POST['address_type'],
            "default_address"=>$_POST['set_default'], 
            "addressable_id"=>$customer_id,
            'addressable_type'=>'App\Customer',
            'created_at'     => Carbon::now()->toDateTimeString(),
            'updated_at'     => Carbon::now()->toDateTimeString(),
        );

         $id=DB::table('addresses')->insertGetId($data);
         if(count($result)>0 ){
         	if ($_POST['set_default']=='yes') {
         		DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->update(['default_address' => "no"]);
         		DB::table('addresses')->where(['id'=>$id,'addressable_type'=>'App\Customer'])->update(['default_address' => "yes"]);
         	}
         }
         if (!empty($id)) {

         	echo '{"Status":"success", "Message":"Address added successfully", "Error":"0000"}';
         	
         }else{

         	echo '{"Status":"failed","message":"Address added failed","error":"100001","data":""}';
         }


        /* try {
		    DB::connection()->getPdo();
		    if($_POST['set_default']=="yes")
            {
            	DB::table('customer_address')->where('user_id', '=',$customer_id)->update(['default_address' => "no"]);
                //now set current address as default
                DB::table('customer_address')->where('id', '=',$id)->update(['default_address' => "yes"]);
              
            }
            echo '{"Status":"success", "Message":"Address added successfully", "Error":"0000"}';
		} catch (\Exception $e) {

		    die("Could not connect to the database.  Please check your configuration. error:" . $e );
		}*/

	}

	public function update_address($address_id)
    {
        $this->validate($_POST['key']);	
        $address_id=$address_id;
        $customer_id=$_POST['customer_id'];
        if ($_POST['set_default']=='yes') {
         		DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->update(['default_address' => "no"]);
         	}
         	
        $data=array(
           "address_title" =>$_POST['name'] , 
            "email_id"		=>$_POST['email'],  
            "phone"			=>$_POST['mobile'],   
            "address_line_1"=>$_POST['address_line_1'], 
            "address_line_2"=>$_POST['address_line_2'], 
            "city"			=>$_POST['city'],  
            "country_name"	=>$_POST['country'],
            "state_name"	=>$_POST['state'],
            'country_id'	=> 356, 
            "zip_code"		=>$_POST['pincode'],  
            "address_type"	=>$_POST['address_type'],
            "default_address"=>$_POST['set_default'],
        );


        DB::table('addresses')->where(['id'=>$address_id])->update($data);

        echo '{"Status":"success", "Message":"Address updated successfully", "Error":"0000"}';
        
    }

    public function all_address(Request $request)
    {
        $this->validate($_POST['key']);	
        $customer_id=$_POST['customer_id'];
        $result=DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->get();
        
        if(count($result)>0)
        {	$data=array();
        	foreach($result as $row){
	        	 $data[]=array( 
	                "id"          		=> $row->id,
		            "user_id"           => $row->addressable_id,
		            "address"           => $row->address_line_1."  ".$row->address_line_2,
		            "city"          	=> $row->city,
		            /*"state"         	=> $this->state_name($row->state_id),
		            "country"          	=> $this->country_name($row->country_id),*/
		            "state"         	=> $row->state_name,
		            "country"          	=> $row->country_name,
		            "pincode"          	=> $row->zip_code,
		            'default_address'	=> $row->default_address,
		            "default_type"      => $row->address_type,
		            "name"              => $row->address_title,
		            "email"          	=> $row->email_id,
		            "mobile"          	=> $row->phone
	        
	             );   
            }
            echo '{"status":"success","message":"Address data","error":"000000","data":'.json_encode($data).'}';
        }
        else{
            echo '{"Status":"failed", "Message":"No address available", "Error":"1005"}';
        }
    }

    public function country_name($id){

    	$result=DB::table('countries')->where(['id'=>$id])->get();
    	if(count($result)>0){

    		return $result[0]->name;
    	}else{

    		return 'none';
    	}
    }

     public function state_name($id){

    	$result=DB::table('states')->where(['id'=>$id])->get();
    	if(count($result)>0){

    		return $result[0]->name;
    	}else{

    		return 'none';
    	}
    }

      public function delete_address(Request $request, $address_id)
    {
        $this->validate($_POST['key']);		
        $customer_id=$_POST['customer_id'];
        	
        DB::table('addresses')->where('id', '=',$address_id)->delete();	
        echo '{"Status":"success", "Message":"Address Deleted", "Error":"0000"}';
    }

    public function myorders(Request $request)
    {	$id=$_POST['customer_id'];
        /*$start=$page_id*10;*/
         $order_get = DB::table('orders')               
        ->where('customer_id', '=', $id)
        ->get();

        $data=array();
        foreach($order_get as $orders){	
           
			switch ($orders->payment_status) {
			    case 1:
			       $payment_status=strtoupper(trans('unpaid'));
			        break;
			    case 2:
			        $payment_status=strtoupper(trans('pending'));
			        break;
			    case 3:
			        $payment_status=strtoupper(trans('paid'));
			        break;
			    case 4:
			        $payment_status=strtoupper(trans('refund_initiated'));
			        break;
			    case 5:
			        $payment_status=strtoupper(trans('partially_refunded'));
			        break;
			    case 6:
			        $payment_status=strtoupper(trans('refunded'));
			        break;
			    default:
			        $payment_status=strtoupper(trans('unpaid'));
			}
			$delivery_status=DB::table('order_statuses')->where(['id'=>$orders->order_status_id])->get();

			$payment_method=DB::table('payment_methods')->where(['id'=>$orders->payment_method_id])->get();
            $data[]=array( 
               'order_id'         =>$orders->id,
               'sale_code'        =>$orders->order_number,
               'payment_type'     =>$payment_method[0]->name,
               'payment_type_code'=>$payment_method[0]->code,
               'payment_status'   =>$payment_status,
               'grand_total'      =>round($orders->grand_total),
               'sale_datetime'    =>$orders->created_at,
               'delivery_status'  =>$delivery_status,
        
            );        

  		}
            echo '{"status":"success","message":"Order list","error":"000000","data":'.json_encode($data).'}';

    }

     public function order_details(Request $request, $order_id)
    {
       /* $order_id->load(['inventories.image','conversation.replies.attachments'])*/;

         $order_detail = DB::table('orders')            
        /*->join('order_items', 'orders.id', '=', 'order_items.order_id')*/
        /*-> join('inventories', 'order_items.inventory_id', '=', 'inventories.id')*/     
        ->where('id', '=', $order_id)
        ->get();

        $orders_item=DB::table('order_items')            
        ->join('inventories', 'order_items.inventory_id', '=', 'inventories.id')
        ->select('.order_items.inventory_id','order_items.item_description','order_items.quantity','order_items.unit_price','inventories.product_id','inventories.set_size','inventories.set_desc','inventories.condition','inventories.title')     
        ->where('order_items.order_id', '=', $order_id)
        ->get();

        $image_id=DB::table('order_items')->where('order_id',$order_id)->get();
        $images_able=array();
       foreach ($image_id as $value) {
         $images_able []=$value->inventory_id;
         $product_image =DB::table('images')->select('path','imageable_id as Inventory_id')
                    ->whereIn('imageable_id',$images_able)
                    ->get(); 
       }
        	switch ($order_detail[0]->payment_status) {
			    case 1:
			       $payment_status=strtoupper(trans('unpaid'));
			        break;
			    case 2:
			        $payment_status=strtoupper(trans('pending'));
			        break;
			    case 3:
			        $payment_status=strtoupper(trans('paid'));
			        break;
			    case 4:
			        $payment_status=strtoupper(trans('refund_initiated'));
			        break;
			    case 5:
			        $payment_status=strtoupper(trans('partially_refunded'));
			        break;
			    case 6:
			        $payment_status=strtoupper(trans('refunded'));
			        break;
			    default:
			        $payment_status=strtoupper(trans('unpaid'));
			}
			$delivery_status=DB::table('order_statuses')->where(['id'=>$order_detail[0]->order_status_id])->get();

			$payment_methods=DB::table('payment_methods')->where(['id'=>$order_detail[0]->payment_method_id])->get();
			$shipping_rate=DB::table('shipping_rates')
			->join('carriers', 'shipping_rates.carrier_id', '=', 'carriers.id')
			->select('shipping_rates.name as shipping_name','carriers.name as carriersName','shipping_rates.delivery_takes','carriers.tracking_url')
			->where(['shipping_rates.id'=>$order_detail[0]->shipping_rate_id])->get();

        	 $data=array( 
               'order_no'         =>$order_detail[0]->order_number,
               'product_details'  =>$orders_item,
               'image'			  =>$product_image,
               'payment_type'     =>$payment_methods[0]->name,
               'payment_status'   =>$payment_status,
               'taxrate'		  =>round($order_detail[0]->taxrate),
               'taxes'		      =>round($order_detail[0]->taxes),
               'wallet_amount_use'=>$order_detail[0]->wallet_amount,
               'shipping_rate'    =>round($order_detail[0]->shipping),
               'sub_total'		      =>round($order_detail[0]->sub_total),
               'total'		      =>round($order_detail[0]->total),
               'grand_total'      =>round($order_detail[0]->grand_total),
               'billing_address'  =>$order_detail[0]->billing_address,
               'shipping_address' =>$order_detail[0]->shipping_address,
               'shipping_date'    =>$order_detail[0]->shipping_date,
               'delivery_date'    =>$order_detail[0]->delivery_date,
               'tracking_id'     =>$order_detail[0]->tracking_id,
               'Shipping_details' =>$shipping_rate,
               'sale_datetime'    =>$order_detail[0]->created_at,
               'delivery_status'  =>$delivery_status[0]->name,
               /*'all_data'		 =>$order_detail*/
        
            );
               
        echo '{"status":"success","message":"Order Data","error":"000000","data":'.json_encode($data).'}';
    }


    public function product_details($id){

    	$listings=Inventory::where('id',$id)->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])->get();

                $data=array();
                foreach ($listings as $row) {
                $images = DB::table('images')->select('path')
                    ->where(['imageable_id'=>$row->id])
                    ->get();

                $data[]=array( 
                   'inventories_id'        =>$row->id,
                   'product_id'            =>$row->product_id,
                   'title'                 =>$row->title,
                   'set_description'       =>$row->set_desc,
                   /*'shipping_cost'         =>$row->shipping_weight,*/
                   'image'                 =>$images,
                   /*'all_data'              =>$row,*/
                      );        
                }

                return $data;

    }

    public function profile_update(Request $request,$id)
    {   
        $this->validate($_POST['key']); 

        $gstin_img=explode('images/', $request->gstin_img);
        $pan_img=explode('images/', $request->pan_img);
        $comp_img=explode('images/', $request->comp_img);  
            $data=array(
                'name'         =>$request->name,
                'email'        =>$request->email,
                'phone'        =>$request->phone,
                'gstin_img'    =>$gstin_img[1],
                'pan_img'      =>$pan_img[1],
                'comp_img'     =>$comp_img[1],
                'gstin'        =>$request->gstin_no,
                'pan_no'       =>$request->pan_no,
                'comp_doc'     =>$request->comp_name,
                'bank_name'    =>$request->bank_name,
                'account_no'   =>$request->account_no,
                'ifsc_code'    =>$request->ifsc_code,
                'cancelled_cheque_no'=>$request->cancelled_cheque_no,
                'cancelled_img'=>$request->cancelled_img,
                'created_at'   => Carbon::now()->toDateTimeString(),
                'updated_at'   => Carbon::now()->toDateTimeString(),
              );

            DB::table('users')->where('id', '=',$id)->update($data);

            echo '{"Status":"success", "Message":"Profile updated successfully", "Error":"0000"}';
    }

    public function supercategory()
    {
    	$this->validate($_POST['key']);

    	 $category=DB::table('master_categories')->get();

    	 $data=array();
    	 foreach ($category as $row) {
    	 	
    	 	$data[]=array(

    	 		'category_id'=>$row->cate_id,
    	 		'category_name'=>$row->name
    	 	);
    	 }

    	  echo '{"status":"success","message":"Super category Data","error":"000000","data":'.json_encode($data).'}';
    }

    public function categoryList()
    {
    	$this->validate($_POST['key']);

    	$categoryId=$_POST['category_id'];

    	$category=DB::table('category_groups')->where(["master_cat_id"=>$categoryId])->get();

    	$data=array();
    	foreach ($category as $row) {

    		$data[]=array(
    			"sub_category_id"	 =>$row->id,
    			"sub_category_name"  =>$row->name,
    		);
    	}

    	echo '{"status":"success","message":"master category Data","error":"000000","data":'.json_encode($data).'}';

    }

    public function Sub_CategoryList()
    {
    	$this->validate($_POST['key']);

    	$categoryListId=$_POST['categoryList_id'];

    	$sub_category=DB::table('category_sub_groups')->where(["category_group_id"=>$categoryListId])->get();

    	$data=array();
    	foreach ($sub_category as $row) {
      		$Child_category=DB::table('categories')->select('id','name')->where(["category_sub_group_id"=>$row->id])->get();

    		$data[]=array(
    			"sub_category_id"	     =>$row->id,
    			"master_category_name"   =>$row->name,
    			"child_category"		 =>$Child_category
    		);
    	}

    	echo '{"status":"success","message":"Sub category Data","error":"000000","data":'.json_encode($data).'}';



    }


	 public function validate($key)
    {
    	if($key!="A123456789")
    	{
    		echo '{"Status":"failed","message":"invalid api key","error":"100001","data":""}';
    		exit();
    	}
    }

    public function generate_random($length = 10) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
            
        $password = '';
     
        while($length--) {
          $key = array_rand($final_array);
          $password .= $final_array[$key];
        }
       return $password;
    }

}
