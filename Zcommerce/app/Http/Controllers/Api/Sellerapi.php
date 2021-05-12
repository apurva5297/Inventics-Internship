<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Product;
use App\Visitor;
use App\Inventory;
use App\Order;
use App\Category;
use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Repositories\Inventory\InventoryRepository;
use Carbon\Carbon;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Address\AddressRepository;

class Sellerapi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $failed_list = [];
    protected $url;
    private $inventory;
    private $customer;
    private $address;

    public function __construct(UrlGenerator $url,InventoryRepository $inventory,CustomerRepository $customer,AddressRepository $address)
    {
        $this->url = $url;
         $this->inventory = $inventory;
         $this->customer = $customer;
         $this->address = $address;

    }

    public function upload_image(Request $request)
    {
       $uri=$this->storeImagePath($request->file);
       $data=explode('images/', $uri);
        
    echo '{"Status":"success","message":"Image Upload SucessFully data","error":"000000","data":"http://simpel.in/images/'.$data[1].'"}';
    }

    private function storeImagePath($image){
        $folderPath = '/var/www/html/public/images/';
        
        //define('UPLOAD_DIR', 'uploads/customer/');
        
        $img = str_replace('data:image/jpeg;base64,', '', $image);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $folderPath . uniqid() . '.jpeg';
        $success = file_put_contents($file, $data);
        return $success ? $file : 'Unable to save the file.';


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

    public function import(Request $request)
    {   
        $this->validate_key($_POST['key']); 
        $this->failed_list = [];
        $category_list=$_POST['category_id'];
   
                $result=$this->createProduct($category_list,$request);
                //echo json_encode($result);
                $final_result=$this->createInventory($result,$request);

                if(!empty($final_result)){
                	echo '{"Status":"success","message":"Product Add SucessFully data","error":"000000","data":}';
                }else{
                	echo '{"Status":"failed","message":"Product added failed data","error":"000000","data":}';
                }
              
    }
   
    public function createInventory($data,$request)
    {	
    	$key[]=1;
        $inventory = Inventory::create([
                        'shop_id' =>$data->shop_id,
                        'title'=>$data->name,
                        'product_id'=>$data->id,
                        'brand'=>$data->brand,    
                        'sku'=>$data->model_number,
                        'condition'=>'New',
                        'is_sample'=>$data->is_sample,
                        'condition_note'=>'Latest Collection',
                        'description'=>$data->description,
                     	'key_features'=>$key,
                        'purchase_price'=>$data->purchase_price,
                        'stock_quantity'=>$data->stock_quantity,
                        'min_order_quantity'=>$data->min_order_quantity,
                        'user_id'=>$data->user_id,
                        'set_size'=>$data->set_size,
                        'set_desc'=>$data->set_desc,
                        'sale_price'=>$data->sale_price,
                        'free_shipping'=>1,
                        'slug'=>$data->slug,
                        'meta_title'=>$data->name,
                        'meta_description'=>$data->description,
                        'active'=>1
                    ]);


        $image=json_decode($data->image);
    
            foreach ($image as $row) {
           
              if ($row)
                $inventory->saveImageFromUrl($row, Null);
            }
        return $inventory;
    }

    /**
     * Create Product
     *
     * @param  array $product
     * @return App\Product
     */
    private function createProduct($category_list,$data)
    {
        $origin_country = DB::table('countries')->select('id')->where('iso_3166_2', strtoupper('IN'))->first();
        /*$manufacturer = Manufacturer::firstOrCreate(['name' => 'LELIJIYE']);*/
      
        $model_number=$this->generate_random();
        // Create the product
        $product = Product::create([
                        'name' => $data->title,
                        'slug' => str_slug($data->title, '-').'-'.$model_number,
                        'model_number' => $model_number,
                        'description' => $data->description,
                        'gtin' => $model_number,
                        'gtin_type' => 'UPC',
                        'mpn' => $model_number,
                        'brand' => 'Alena',
                        'origin_country' => isset($origin_country) ? $origin_country->id : Null,
                        'manufacturer_id' => 9,
                        'min_price' => 0,
                        'max_price' => Null,
                        'requires_shipping' => 1,
                        'shop_id' => $data->shop_id,
                        'active' => 1,
                    ]);


        // Sync categories
        if($category_list)
            $product->categories()->sync($category_list);

        // Upload featured image
       $image=json_decode($data->image);
    
            foreach ($image as $row) {
           
              if ($row)
                $product->saveImageFromUrl($row, true);
            }

        
        $product['set_desc']=$data->set_desc;
        $product['set_size']=$data->set_size;
        $product['sale_price']=$data->sale_price;
        $product['is_sample']=$data->is_sample;
        $product['min_order_quantity']=$data->min_order_quantity;
        $product['stock_quantity']=$data->stock_quantity;
        $product['image']=$data->image;
        $product['purchase_price']=$data->mrp;
        $product['user_id']=$data->user_id;

        return $product;
    }

    private function pushIntoFailed(array $data, $reason = Null)
    {
        $row = [
            'data' => $data,
            'reason' => $reason,
        ];

        array_push($this->failed_list, $row);
    }

    private function getFailedList()
    {
        return $this->failed_list;
    }

    public function client_doc_upload(Request $request)
    {
       $uri=$this->storeClientImagePath($request->file);
       $data=explode('client/', $uri);
        
    echo '{"Status":"success","message":"Cliend Documnet Upload SucessFully data","error":"000000","data":http://simpel.in/images/client/'.$data[1].'}';
    }

    private function storeClientImagePath($image){
        $folderPath = '/var/www/html/public/images/client/';
        
        //define('UPLOAD_DIR', 'uploads/customer/');
        
        $img = str_replace('data:image/jpeg;base64,', '', $image);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $folderPath . uniqid() . '.jpeg';
        $success = file_put_contents($file, $data);
        return $success ? $file : 'Unable to save the file.';


    }
      public function seller_profile_detail(Request $request,$id)
    {   
        $this->validate_key($_POST['key']); 

        $data=DB::table('users')->where('id', '=',$id)->first();
        $address=$this->address->addresses('User', $id);
          $details=array(
                'id'           =>$data->id,
                'role_id'      =>$data->role_id,
                'name'         =>$data->name,
                'email'        =>$data->email,
                'phone'        =>$data->phone,
                'gstin_img'    =>'http://simpel.in/images/client/'.$data->gstin_img,
                'pan_img'      =>'http://simpel.in/images/client/'.$data->pan_img,
                'comp_img'     =>'http://simpel.in/images/client/'.$data->comp_img,
                'gstin'        =>$data->gstin,
                'pan_no'       =>$data->pan_no,
                'comp_name'     =>$data->comp_doc,
                'bank_name'    =>$data->bank_name,
                'account_no'   =>$data->account_no,
                'ifsc_code'    =>$data->ifsc_code,
                'cancelled_cheque_no'=>$data->cancelled_cheque_no,
                'cancelled_img'=>'http://simpel.in/images/client/'.$data->cancelled_img,
                'address'      =>$address['addresses']
              );
          echo '{"Status":"success","message":"Seller Profile  detail","error":"000000","data":'.json_encode($details).'}';
    }

    public function profile_update(Request $request,$id)
    {   
        $this->validate_key($_POST['key']); 

        $gstin_img=explode('client/', $request->gstin_img);
        $pan_img=explode('client/', $request->pan_img);
        $comp_img=explode('client/', $request->comp_img); 
        $cancelled_img=explode('client/', $request->cancelled_img);  
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
                'cancelled_img'=>$cancelled_img[1],
                'created_at'   => Carbon::now()->toDateTimeString(),
                'updated_at'   => Carbon::now()->toDateTimeString(),
              );

            DB::table('users')->where('id', '=',$id)->update($data);

            echo '{"Status":"success", "Message":"Profile updated successfully", "Error":"0000"}';
    }

    public function product_list(Request $request,$shop_id)
    {

        $products=DB::table('inventories')
                 ->join('products', 'inventories.product_id', '=', 'products.id')
                 ->join('category_product', 'products.id', '=', 'category_product.product_id')
                 ->where('inventories.shop_id', '=',$shop_id)
                 ->get();

        $data=array();
       
        foreach ($products as $row) {
               $inventories_id= DB::table('inventories')
                    ->where(['product_id'=>$row->id])
                    ->get();
                $images = DB::table('images')->select('path')
                    ->where(['imageable_id'=>$inventories_id[0]->id,'imageable_type'=>'App\Inventory'])
                    ->get();

                $set=$row->set_size;
                $pp=floor($row->sale_price);
                $total=@($pp/$set);

                $dis_set=$row->set_size;
                $dis_pp=floor($row->offer_price);
                $dis_total=@($dis_pp/$dis_set);

            $data[]=array( 
                  'inventories_id'        =>$inventories_id[0]->id,
                   'title'                 =>$row->title,
                   'sale_price'            =>round($total),
                   'set_price'             =>round($row->sale_price),
                   'unit'                  =>'Piece',
                   'offer_price'           =>round($dis_total),
                   'set_offer_price'       =>round($row->offer_price),
                   'description'           =>strip_tags($row->description),
                   'current_stock'         =>$row->stock_quantity,
                   'single_pc'             =>$row->is_sample,
                   'set_size'              =>$row->set_size,
                   'set_description'       =>$row->set_desc,
                   'min_order_quantity'    =>$row->min_order_quantity,
                   'free_shipping'         =>$row->free_shipping,
                  'image'                 =>$images,
               /*'all_data'              =>$row,*/
        
            );        

          }         

        echo '{"Status":"success","message":"All Product  List","error":"000000","data":'.json_encode($data).'}';

    }

    public function update_product(Request $request,$id)
    {   
        if ($request->delete_image == 1){

         DB::table('images')->where(['imageable_id'=>$id,'imageable_type'=>'App\Inventory'])->delete();   
        }
        $request['variants']=array();
        $inventory = $this->inventory->update($request, $id);

         $image=json_decode($_POST['image']);
    
            foreach ($image as $row) {
           
              if ($request->image)
                $inventory->saveImageFromUrl($row->image, Null);
            }
        
            echo '{"Status":"success", "Message":"Product updated successfully", "Error":"0000"}';
    }

    public function product_price_list(Request $request)
    {
        $data=DB::table('inventories')->where(['shop_id'=>$request->shop_id])->get();

            $result=array();

            foreach ($data as $row) {
                
                $result[]=array(

                    'id'        =>$row->id,
                    'title'     =>$row->title,
                    'brand'     =>$row->brand,
                    'sku'       =>$row->sku,
                    'set_size'  =>$row->set_size,
                    'set_desc'  =>$row->set_desc,
                    'sale_price'=>$row->sale_price
                );
            }

          echo '{"Status":"success","message":"Product List","error":"000000","data":'.json_encode($result).'}';
       
    }

    public function product_price_update(Request $request,$id)
    {
        $product=DB::table('inventories')->select('id','sale_price')->where(['id'=>$id])->get();
        if (count($product) > 0) {

            DB::table('inventories')->where('id', '=',$id)->update(['sale_price'=>$request->price]);
            $data=array(
                'inventories_id'=>$product[0]->id,
                'current_price' =>$product[0]->sale_price,
                'new_price'     =>$request->price,
                'created_at'    => Carbon::now()->toDateTimeString(),
                'updated_at'    => Carbon::now()->toDateTimeString(),
            );

            \DB::table('inventories_updated_price')->insert($data);
        }

        echo '{"Status":"success", "Message":"Price Update successfully", "Error":"0000"}';

    }

    public function product_delete(Request $request,$id)
    {
         $product=DB::table('inventories')->select('id','product_id')->where(['id'=>$id])->get();

         if (count($product) >0) {
             DB::table('products')->where(['id'=>$product[0]->product_id])->delete();
             DB::table('images')->where(['imageable_id'=>$product[0]->id])->delete();
             DB::table('inventories')->where(['id'=>$product[0]->id])->delete();
         }

         echo '{"Status":"success", "Message":"Product Delete successfully", "Error":"0000"}';

         
    }

    public function order_list(Request $request)
    {   $id=$_POST['shop_id'];
        /*$start=$page_id*10;*/
         $order_get = DB::table('orders')               
        ->where('shop_id', '=', $id)
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
        echo '{"Status":"success","message":"Product List","error":"000000","data":'.json_encode($data).'}';

    }

         public function seller_order_details(Request $request, $order_id)
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
               'order_id'         =>$order_id,
               'order_no'         =>$order_detail[0]->order_number,
               'product_details'  =>$orders_item,
               'image'            =>$product_image,
               'payment_type'     =>$payment_methods[0]->name,
               'payment_status'   =>$payment_status,
               'taxrate'          =>round($order_detail[0]->taxrate),
               'taxes'            =>round($order_detail[0]->taxes),
               'wallet_amount_use'=>$order_detail[0]->wallet_amount,
               'shipping_rate'    =>round($order_detail[0]->shipping),
               'sub_total'        =>round($order_detail[0]->sub_total),
               'total'            =>round($order_detail[0]->total),
               'grand_total'      =>round($order_detail[0]->grand_total),
               'billing_address'  =>$order_detail[0]->billing_address,
               'shipping_address' =>$order_detail[0]->shipping_address,
               'shipping_date'    =>$order_detail[0]->shipping_date,
               'delivery_date'    =>$order_detail[0]->delivery_date,
               'tracking_id'     =>$order_detail[0]->tracking_id,
               'Shipping_details' =>$shipping_rate,
               'sale_datetime'    =>$order_detail[0]->created_at,
               'delivery_status'  =>$delivery_status[0]->name,
               /*'all_data'      =>$order_detail*/
        
            );
               
        echo '{"status":"success","message":"Order Data","error":"000000","data":'.json_encode($data).'}';
    }


    public function order_status_update(Request $request,$order_id)
    {
        DB::table('orders')->where(['id'=>$order_id])->update(['order_status_id' => 2]);

        echo '{"status":"success","message":"Order Status Confirmed","error":"000000","data":}';
    }

    public function agent_doc_upload(Request $request)
    {
       $uri=$this->storeAgentImagePath($request->file);
       $data=explode('agent/', $uri);
        
    echo '{"Status":"success","message":"Cliend Documnet Upload SucessFully data","error":"000000","data":http://simpel.in/images/agent/'.$data[1].'}';
    }

    private function storeAgentImagePath($image){
        $folderPath = '/var/www/html/public/images/agent/';
        
        //define('UPLOAD_DIR', 'uploads/customer/');
        
        $img = str_replace('data:image/jpeg;base64,', '', $image);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $folderPath . uniqid() . '.jpeg';
        $success = file_put_contents($file, $data);
        return $success ? $file : 'Unable to save the file.';


    }

    public function agent_profile_details(Request $request , $id)
    {

      $this->validate_key($_POST['key']); 

        $data=DB::table('users')->where('id', '=',$id)->first();
        $address=$this->address->addresses('User', $id);
          $details=array(
                'id'           =>$data->id,
                'role_id'      =>$data->role_id,
                'name'         =>$data->name,
                'email'        =>$data->email,
                'phone'        =>$data->phone,
                'pan_img'      =>'http://simpel.in/images/agent/'.$data->pan_img,
                'pan_no'       =>$data->pan_no,
                'bank_name'    =>$data->bank_name,
                'account_no'   =>$data->account_no,
                'ifsc_code'    =>$data->ifsc_code,
                'cancelled_cheque_no'=>$data->cancelled_cheque_no,
                'cancelled_img'=>'http://simpel.in/images/agent/'.$data->cancelled_img,
                'address'      =>$address['addresses']
              );
          echo '{"Status":"success","message":"Agent Profile  detail","error":"000000","data":'.json_encode($details).'}';

    }


    public function agent_profile_update(Request $request,$id)
    {   
        $this->validate_key($_POST['key']); 

        /*$gstin_img=explode('agent/', $request->gstin_img);*/
        $pan_img=explode('agent/', $request->pan_img);
        /*$comp_img=explode('agent/', $request->comp_img); */
        $cancelled_img=explode('agent/', $request->cancelled_img);  
            $data=array(
                'name'         =>$request->name,
                'email'        =>$request->email,
                'phone'        =>$request->phone,
                /*'gstin_img'    =>$gstin_img[1],*/
                'pan_img'      =>$pan_img[1],
               /* 'comp_img'     =>$comp_img[1],*/
               /* 'gstin'        =>$request->gstin_no,*/
                'pan_no'       =>$request->pan_no,
                /*'comp_doc'     =>$request->comp_name,*/
                'bank_name'    =>$request->bank_name,
                'account_no'   =>$request->account_no,
                'ifsc_code'    =>$request->ifsc_code,
                'cancelled_cheque_no'=>$request->cancelled_cheque_no,
                'cancelled_img'=>$cancelled_img[1],
                'created_at'   => Carbon::now()->toDateTimeString(),
                'updated_at'   => Carbon::now()->toDateTimeString(),
              );

            DB::table('users')->where('id', '=',$id)->update($data);

            echo '{"Status":"success", "Message":"Profile updated successfully", "Error":"0000"}';
    }


    public function agent_buyerList(Request $request)
    {   
        $this->validate_key($_POST['key']); 
       $data=DB::table('customers')->get();
            $result=array();
            foreach ($data as $row) {
               
               $result[]=array(

                    "id"         =>$row->id,
                    "name"       =>$row->name,
                    "email"      =>$row->email,
                    "phone"      =>$row->phone,
                    "gstin"      =>$row->gstin,
                    "pan_no"     =>$row->pan_no,
                    "com_name"   =>$row->comp_doc,
                    "created_at" =>$row->created_at
               );
            }
         echo '{"status":"success","message":"customers Data","error":"000000","data":'.json_encode($result).'}';
    }

    public static function Days($days = Null, $format = 'F d', $start = Null)
    {
      if(!$days)
        $days = config('charts.default.days', 30);

    if(!$start)
      $start = Carbon::today();

    $data = [];
    for ($i = $days-1; $i >= 0; $i--) {
        $data[] = $start->copy()->subDays($i)->format($format);
    }

    return $data;
    }


    public static function today_sale_count(Request $request)
    {
            $total=Order::where(['shop_id'=>$_POST['shop_id']])->withTrashed()->whereDate('created_at', \Carbon\Carbon::today())->sum('total');
            $total_sale['total']=round($total);

            echo '{"status":"success","message":"Today Total Sale","error":"000000","data":'.json_encode($total_sale).'}';
        
    }


      public static function visitor_count($period = 'today')
    {
        $visitor = new Visitor;

        if ($period == Null)
            return $visitor->count();
        else if(is_numeric($period))
            $date = Carbon::today()->subDays($period)->startOfDay();
        else if ($period == 'today')
            $date = Carbon::today()->startOfDay();
        else
            $date = Carbon::today()->startOfDay();

        $total_visit['visit']=$visitor->of($date)->count();

        echo '{"status":"success","message":"Today Total Visit","error":"000000","data":'.json_encode($total_visit).'}';
    }

     public function product_visit_count(Request $request)
    {
            $total_hits['visit']=DB::table('product_visit_count')->where(['shop_id'=>$_POST['shop_id']])->whereDate('created_at', \Carbon\Carbon::today())->sum('hits');

            echo '{"status":"success","message":"Today Product visit Count","error":"000000","data":'.json_encode($total_hits).'}';
        
    }


    public  function visitorsOfMonths(Request $request)
     {

        $this->validate_key($_POST['key']);

        $month=Carbon::now()->month;
        $year = Carbon::now()->year;
        $date = Carbon::createFromDate($year,$month);
        $numberOfWeeks = floor($date->daysInMonth / Carbon::DAYS_PER_WEEK);
        $start = [];
        $end = [];
        $j=1;
        for ($i=1; $i <= $date->daysInMonth ; $i++)
         {
            Carbon::createFromDate($year,$month,$i); 
            $start['Week: '.$j.' Start Date']= (array)Carbon::createFromDate($year,$month,$i)->startOfWeek()->toDateString();
            $end['Week: '.$j.' End Date']= (array)Carbon::createFromDate($year,$month,$i)->endOfweek()->toDateString();
            $i+=7;
            $j++; 
         }
        $result = array_merge($start,$end);
        $result['numberOfWeeks'] = ["$numberOfWeeks"];
       
        $datestart=array();
        foreach ($start as $row)
         {
    
            $datestart[]=$row;
         }

        $dateend=array();
        foreach ($end as $row2) 
        {
            
            $dateend[]=$row2;
        }

        $data=array();
        $clength = count($datestart);
            for($x = 0; $x < $clength; $x++)
             {
                $data[]=$datestart[$x];
                
             }

        $data2=array();
        $clength2 = count($dateend);
            for($x = 0; $x < $clength2; $x++) 
            {
                $data2[]=$dateend[$x];
            }

         $total_hits=array();
        for($d = 0; $d < $numberOfWeeks; $d++) 
          {
            $total_hits[$d]=DB::table('product_visit_count')->where(['shop_id'=>$_POST['shop_id']])->whereDate('created_at', '>=',$data[$d][0])->whereDate('created_at', '<=',$data2[$d][0])->sum('hits');        
           }
         $nowMonth=Carbon::now()->format('M');

         $visitor=implode(" ",$total_hits);
         $visitor2['visitor']=explode(' ', $visitor);
         echo '{"status":"success","message":"Total visitor of '.$nowMonth.'","error":"000000","data":'.json_encode($visitor2).'}';
    }


    public function validate_key($key)
    {
        if($key!="A123456789")
        {
            echo '{"Status":"failed","message":"invalid api key","error":"100001","data":""}';
            exit();
        }
    }
}