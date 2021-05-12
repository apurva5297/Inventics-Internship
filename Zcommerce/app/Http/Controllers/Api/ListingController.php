<?php

namespace App\Http\Controllers\Api;
use DB;
use DateTime;
use App\Inventory;
use App\Order;
use App\Common\Authorizable;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ListingResource;
use App\CategoryGroup;
use App\Category;
use Carbon\Carbon;
use App\Http\Requests\Validations\CreateOrderRequest;
use App\Events\Order\OrderCreated;
use App\Repositories\Order\OrderRepository;
class ListingController extends Controller
{   
  
    private $order;

  public function __construct(OrderRepository $order)
    {
        parent::__construct();
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //'latest'
    {   
        $this->check($_POST['key']);

    $listings=Inventory::with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->orderBy('id', 'desc')->take(5)->get();
        
        $data=array();
        foreach ($listings as $row) {
            $images = DB::table('images')->select('path')
                ->where(['imageable_id'=>$row->id])
                ->get();

                $set=$row->set_size;
                $pp=floor($row->sale_price);
                $total=@($pp/$set);

            $data[]=array( 
               'inventories_id'        =>$row->id,
               'product_id'            =>$row->product_id,
               'title'                 =>$row->title,
               'sale_price'            =>round($total),
               'set_price'             =>round($row->sale_price),
               'unit'                  =>'Piece',
               'discount'              =>round($row->offer_price),
               'current_stock'         =>$row->stock_quantity,
               'single_pc'             =>$row->is_sample,
               'set_size'              =>$row->set_size,
               'set_description'       =>$row->set_desc,
               'shipping_cost'         =>$row->shipping_weight,
               'image'                 =>$images,
               /*'all_data'              =>$row,*/
        
            );        

            }      

        echo '{"Status":"success","message":"new Products","error":"000000","data":'.json_encode($data).'}';
    }

     public function featured_products(Request $request) //'latest'
    {   
        $this->check($_POST['key']);

        $order_count= DB::table('order_items')->get();

            $user_info =  DB::table('order_items')
            ->select('inventory_id', DB::raw('COUNT(*) as total'))
            ->groupBy('inventory_id')
            ->having('total', '>=' , 1)
            ->get();
        //$order_items=count( $user_info);
        if (count($user_info) >=1) {
                //$data='true';
                foreach ($user_info as  $value) {
                 $data[]=$value->inventory_id;
                }

                 $listings=Inventory::whereIn('id',$data)->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
                    ->orderBy('id', 'desc')->take(5)->get();

                $all_products=array();
                foreach ($listings as $row) {
                $images = DB::table('images')->select('path')
                    ->where(['imageable_id'=>$row->id])
                    ->get();

                $set=$row->set_size;
                $pp=floor($row->sale_price);
                $total=@($pp/$set);

                $all_products[]=array( 
                   'inventories_id'        =>$row->id,
                   'product_id'            =>$row->product_id,
                   'title'                 =>$row->title,
                   'sale_price'            =>round($total),
                   'set_price'             =>round($row->sale_price),
                   'unit'                  =>'Piece',
                   'offer_price'           =>round($row->offer_price),
                   'current_stock'         =>$row->stock_quantity,
                   'single_pc'             =>$row->is_sample,
                   'set_size'              =>$row->set_size,
                   'set_description'       =>$row->set_desc,
                   'shipping_cost'         =>$row->shipping_weight,
                   'image'                 =>$images,
                   /*'all_data'              =>$row,*/
                      );        

                }      
            }else{

            $all_products='none';
        }
     
        echo '{"Status":"success","message":"featured products","error":"000000","data":'.json_encode($all_products).'}';
    }

     public function featured_category($page_id) // send category data as per page id
    {
        $this->check($_POST['key']); 
        $start=$page_id*10;
       
            $featured_cat=DB::table('categories')
                 ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                 ->where('categories.featured', '=',1)
                 /*->offset(0)
                 ->take($start)*/
                 ->get();

                $images = DB::table('images')
                    ->where(['imageable_id'=>$featured_cat[0]->category_id,'imageable_type'=>'App\Category'])
                    ->get(); 
                 $subtitles=$featured_cat[0]->description;
                $data['title']=$featured_cat[0]->name;
                $data['subtitle']=strip_tags(htmlspecialchars_decode($subtitles));
                $data['color_code']='#2980B9';
                $data['image']='http://simpel.in/image/'.$images[0]->path;

             if (count($featured_cat) >=1) {
                //$data='true';
                foreach ($featured_cat as  $value) {
                 $product_id[]=$value->product_id;
                }
               /* print_r($product_id);
                exit();
*/
                 $listings=Inventory::whereIn('id',$product_id)->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
                    ->orderBy('id', 'desc')->take(4)->get();

                $all_products=array();
                foreach ($listings as $row) {
                $images = DB::table('images')->select('path')
                    ->where(['imageable_id'=>$row->id])
                    ->get();

                $set=$row->set_size;
                $pp=floor($row->sale_price);
                $total=@($pp/$set);

                $dis_set=$row->set_size;
                $dis_pp=floor($row->offer_price);
                $dis_total=@($dis_pp/$dis_set);

                $all_products[]=array( 
                   'inventories_id'        =>$row->id,
                   'product_id'            =>$row->product_id,
                   'title'                 =>$row->title,
                   'sale_price'            =>round($total),
                   'set_price'             =>round($row->sale_price),
                   'unit'                  =>'Piece',
                   'offer_price'           =>round($dis_total),
                   'set_offer_price'       =>round($row->offer_price),
                   'current_stock'         =>$row->stock_quantity,
                   'single_pc'             =>$row->is_sample,
                   'set_size'              =>$row->set_size,
                   'set_description'       =>$row->set_desc,
                   'shipping_cost'         =>$row->shipping_weight,
                   'image'                 =>$images,
                   /*'all_data'              =>$row,*/
                      );        

                }      
            }else{

            $all_products='none';
        }
        $data['products']=$all_products;

        echo '{"status":"success","message":"featured category product list","error":"000000","data":'.json_encode($data).'}';
    }

     public function featured_brand($page_id) // send brand data as per page id
    {
        $this->check($_POST['key']); 

        // return title, subtitle and 4 products
        $data['title']='Alena';
        $data['subtitle']='Branded Quality';
        
        $data['image']='http://www.simpel.in/image/images/9neYfMipxvYX1xeS2sEx2eh4t3VR9yNimig6ZHMq.jpeg';

       $listings=Inventory::with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
         ->inRandomOrder()->take(4)->get();
        
        $product_list=array();
        foreach ($listings as $row) {
            $images = DB::table('images')->select('path')
                ->where(['imageable_id'=>$row->id])
                ->get();

                $set=$row->set_size;
                $pp=floor($row->sale_price);
                $total=@($pp/$set);

                 $dis_set=$row->set_size;
                $dis_pp=floor($row->offer_price);
                $dis_total=@($dis_pp/$dis_set);

            $product_list[]=array( 
               'inventories_id'        =>$row->id,
               'product_id'            =>$row->product_id,
               'title'                 =>$row->title,
               'sale_price'            =>round($total),
               'set_price'             =>round($row->sale_price),
               'unit'                  =>'Piece',
               'offer_price'           =>round($dis_total),
               'set_offer_price'      =>round($row->offer_price),
               'current_stock'         =>$row->stock_quantity,
               'single_pc'             =>$row->is_sample,
               'set_size'              =>$row->set_size,
               'set_description'       =>$row->set_desc,
               'shipping_cost'         =>$row->shipping_weight,
               'image'                 =>$images,
               'shipping_weight'       =>$row->shipping_weight,
               'available'             =>$row->active, 
               'is_free_shipping'      =>$row->free_shipping,
               'measuring_unit_id'     =>$row->MeasuringUnit->id,
               'measuring_unit_name'   =>$row->MeasuringUnit->name,
               'measuring_unit_symbol' =>$row->MeasuringUnit->symbol

               /*'all_data'              =>$row,*/
        
            );        

            }
            $data['products']=$product_list;      

        echo '{"status":"success","message":"featured brand List","error":"000000","data":'.json_encode($data).'}';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item(Request $request,$id)
    {   
        $this->check($_POST['key']);
     
      $listings=Inventory::where('product_id',$id)->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])->get();

      $data=array();
        foreach ($listings as $row) {

            $result=DB::table('product_visit_count')->where(['inventories_id'=>$row->id,'shop_id'=>$row->shop_id])->whereDate('created_at', \Carbon\Carbon::today())->get();
          
          if (count($result) > 0) {
                DB::table('product_visit_count')->where('visit_id', $result[0]->visit_id)->increment('hits', 1,['updated_at' => Carbon::now()]);
          }else{

               $visit=array(
                'inventories_id'=>$row->id,
                'shop_id'       =>$row->shop_id,
                'hits'          =>1,
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
                 );
              DB::table('product_visit_count')->insert($visit); 
          }

                $images = DB::table('images')->select('path')
                    ->where(['imageable_id'=>$row->id])
                    ->get();

                $set=$row->set_size;
                $pp=floor($row->sale_price);
                $total=@($pp/$set);

                $dis_set=$row->set_size;
                $dis_pp=floor($row->offer_price);
                $dis_total=@($dis_pp/$dis_set);

                $margin_retail=intval(($row->sale_price-$row->purchase_price)*100/$row->purchase_price);

                $data[]=array( 
                   'inventories_id'        =>$row->id,
                   'product_id'            =>$row->product_id,
                   'title'                 =>$row->title,
                   'sale_price'            =>round($total),
                   'set_price'             =>round($row->sale_price),
                   'unit'                  =>'Piece',
                   'offer_price'           =>round($dis_total),
                   'set_offer_price'       =>round($row->offer_price),
                   'purchase_price'        =>round($row->purchase_price),
                   'description'            =>strip_tags(htmlspecialchars_decode($row->description)),
                   'current_stock'         =>$row->stock_quantity,
                   'single_pc'             =>$row->is_sample,
                   'set_size'              =>$row->set_size,
                   'shipping_weight'       =>$row->shipping_weight,
                   'set_description'       =>$row->set_desc,
                   'min_order_quantity'   =>$row->min_order_quantity,
                   'free_shipping'         =>$row->free_shipping,
                   'margin'                =>$margin_retail,
                   'image'                 =>$images,
                   /*'all_data'              =>$row,*/
                      );        
                }
             /* $data['margin']= intval(($row->purchase_price/$row->sale_price)*100); */ 

        echo '{"Status":"success","message":"product data","error":"000000","data":'.json_encode($data).'}';
    }




    public function browseCategoryGroup(Request $request, $sortby = Null)
    {   
        $this->check($_POST['key']); 
        $id=$_POST['id']
        /*$id=$request->id*/;
        $start=$_POST['page_id']*10;
        $slug = CategoryGroup::find($id);

        $categoryGroup = CategoryGroup::where('slug', $slug->slug)->with(['categories' => function($q){
            $q->select(['categories.id','categories.slug','categories.category_sub_group_id','categories.name'])
            ->where('categories.active', 1)->whereHas('listings')->withCount('listings');
        }])->active()->firstOrFail();

        $categories = $categoryGroup->categories;

        $all_products = prepareFilteredListings($request, $categoryGroup);

       $data=array();
        foreach ($all_products as $row) {
           
            $data[]=array( 
               'product_id'            =>$row->product_id,
               'title'                 =>$row->title,
               'sale_price'            =>round($row->sale_price),
               'unit'                  =>'Piece',
               'discount'              =>round($row->offer_price),
               'current_stock'         =>$row->stock_quantity,
               'all_data'              =>$row,
        
            );        

            }

        echo '{"Status":"success","message":"All Product CategoryBy","error":"000000","data":'.json_encode($data).'}';
    }

     public function browseCategory(Request $request, $id, $page_id)
    {   
        $this->check($_POST['key']);

        $start=$page_id*10;
    
        $categories_id=DB::table('categories')->where(['category_sub_group_id'=>$id])->get();

        $products=DB::table('inventories')
                 ->join('products', 'inventories.product_id', '=', 'products.id')
                 ->join('category_product', 'products.id', '=', 'category_product.product_id')
                 ->where('category_product.category_id', '=',$categories_id[0]->id)
                 ->offset(0)
                 ->take($start)
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
                   'product_id'            =>$row->product_id,
                   'title'                 =>$row->title,
                   'sale_price'            =>round($total),
                   'set_price'             =>round($row->sale_price),
                   'unit'                  =>'Piece',
                   'offer_price'           =>round($dis_total),
                   'set_offer_price'       =>round($row->offer_price),
                   'description'           =>strip_tags(htmlspecialchars_decode($row->description)),
                   'current_stock'         =>$row->stock_quantity,
                   'single_pc'             =>$row->is_sample,
                   'set_size'              =>$row->set_size,
                   'set_description'       =>$row->set_desc,
                   'min_order_quantity'   =>$row->min_order_quantity,
                   'free_shipping'         =>$row->free_shipping,
                  'image'                 =>$images,
               /*'all_data'              =>$row,*/
        
            );        

          }         

        echo '{"Status":"success","message":"All Product by category","error":"000000","data":'.json_encode($data).'}';
    }

      public function products_by_subcategory(Request $request, $id, $page_id)
    {   
        $this->check($_POST['key']);
        $start=$page_id*10;

        $products=DB::table('inventories')
                 ->join('products', 'inventories.product_id', '=', 'products.id')
                 ->join('category_product', 'products.id', '=', 'category_product.product_id')
                 ->where('category_product.category_id', '=',$id)
                 ->offset(0)
                 ->take($start)
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
                   'product_id'            =>$row->product_id,
                   'title'                 =>$row->title,
                   'sale_price'            =>round($total),
                   'set_price'             =>round($row->sale_price),
                   'unit'                  =>'Piece',
                   'offer_price'           =>round($dis_total),
                   'set_offer_price'       =>round($row->offer_price),
                   'description'           =>$row->description,
                   'current_stock'         =>$row->stock_quantity,
                   'single_pc'             =>$row->is_sample,
                   'set_size'              =>$row->set_size,
                   'set_description'       =>$row->set_desc,
                   'min_order_quantity'    =>$row->min_order_quantity,
                   'free_shipping'         =>$row->free_shipping,
                    'image'                =>$images,
               /*'all_data'              =>$row,*/
        
            );        

            }         

        echo '{"Status":"success","message":"All Product by Subcategory","error":"000000","data":'.json_encode($data).'}';
    }

     public function browseCategorySubGrp(Request $request, $slug, $sortby = Null)
    {
        $this->check($_POST['key']);

         $id=$_POST['id'];
        $start=$_POST['page_id']*10;
        $slug = CategorySubGroup::find($id);

        $categorySubGroup = CategorySubGroup::where('slug', $slug)->with(['categories' => function($q){
            $q->select(['id','slug','category_sub_group_id','name'])->whereHas('listings')->active();
        }])->active()->firstOrFail();

        $categories = $categorySubGroup->categories;

        $all_products = prepareFilteredListings($request, $categorySubGroup);

        // Paginate the results
        $products = $all_products->paginate(config('system.view_listing_per_page', $start))->appends($request->except('page'));

        $data=array();
        foreach ($products as $row) {
           
            $data[]=array( 
               'product_id'            =>$row->product_id,
               'title'                 =>$row->title,
               'sale_price'            =>round($row->sale_price),
               'unit'                  =>'Piece',
               'discount'              =>round($row->offer_price),
               'current_stock'         =>$row->stock_quantity,
               'image'                 =>$row->images,
               'all_data'              =>$row,
        
            );        

            }

        echo '{"Status":"success","message":"All Product Category","error":"000000","data":'.json_encode($data).'}';

        
    }

     public function details_by_id(Request $request)
    {
        //$this->check($_POST['key']);

        $id=$request->id;
        $data =DB::table('inventories')->where('product_id', $id)->first();
        /*$data = Inventory::where(['product_id'=>$id])->get();*/

           //echo $data->description;
     return view('mob_product_specification', compact('data'));
        
    }

    public function getDescription(Request $request)
    {
        $id=$request->id;
        $data =DB::table('inventories')->where('product_id', $id)->first();
        $results=strip_tags(htmlspecialchars_decode($data->description));
        echo $results;
    }


    public function check($key)
    {
        if($key!="A123456789")
        {
            echo '{"Status":"failed","message":"invalid api key","error":"100001","data":""}';
            exit();
        }
    }

    public function order_place(Request $request)
    {
        /*$order = $this->order->store($request);

        event(new OrderCreated($order));*/

        $input = json_decode($_POST['data']);
        $order_items = json_decode($_POST['data']);
        $total=0;
        $quantity=0;
        $shipping_weight=0;
        foreach ($input as $value) {
          $product_id[]=$value->product_id;
          $quantity_item[]=$value->quantity;
          $quantity +=$value->quantity;
          $listings=Inventory::where('product_id',$value->product_id)
                /*->select(DB::raw('SUM(sale_price) as total_price'),'sale_price')*/
                ->get();
              foreach ($listings as $row) {
                $shop_id=$row->shop_id;
                $shipping_weight +=$row->shipping_weight;
                $total +=round($row->sale_price)*$value->quantity;
              }
          }

          $shipping_rates =DB::table('shipping_rates')->where('id', $_POST['shipping_id'])->first();

        $Shipping_address=DB::table('addresses')->where(['addressable_id'=>$_POST['customer_id'],'addressable_type'=>'App\Customer','default_address'=>'yes'])->get();
        $billing_addres=DB::table('addresses')->where(['addressable_id'=>$_POST['customer_id'],'addressable_type'=>'App\Customer','address_type'=>'Billing'])->get();
        if (count($billing_addres) >0) {
              $billing_address=$billing_addres;
        }else{

          $billing_address=$Shipping_address;
        }

        $taxes =DB::table('taxes')->where(['shop_id'=>11,'country_id'=>356])->first();
        $taxes_rate=round($taxes->taxrate);

       if($_POST['balance_use'] > 0){

            $grand_total=$total-$_POST['balance_use'];
        }else{

            $grand_total=$total;
        }

       /* $grand_total=$total+$shipping_rates->rate;*/
        $grand_total_taxes=$grand_total*$taxes_rate/100;
        $grand_total_with_taxes=$grand_total+$grand_total_taxes;
        $grand_total_with_discount=$grand_total_with_taxes+$shipping_rates->rate;
        /*echo $total;
        echo "<br>";
        echo  $grand_total_taxes;
        exit();*/
     /*   echo  $grand_total_with_discount;
exit();*/
        $data=array(

          'order_number'      =>'#'.rand(1, 999999),
          'shop_id'           =>$shop_id,
          'customer_id'       =>$_POST['customer_id'],
          'item_count'        =>count($product_id),
          'quantity'          =>$quantity,
          'sub_total'         =>$total,
          'total'             =>$grand_total,
          'shipping_zone_id'  =>14,
          'shipping_rate_id'  =>$shipping_rates->id,
          'shipping_weight'   =>$shipping_weight,
          'taxrate'           =>$taxes_rate,
          'taxes'             =>$grand_total_taxes,
          'wallet_amount'     =>$_POST['balance_use'],
          'shipping'          =>$shipping_rates->rate,
          'grand_total'       =>$grand_total_with_discount,
          'billing_address'   =>$billing_address[0]->address_line_1. $billing_address[0]->address_line_2.','.$billing_address[0]->city.','.$billing_address[0]->state_name.' ,('.$billing_address[0]->zip_code.')'.  $billing_address[0]->country_name.','.'Contact No:-'.$billing_address[0]->phone,
          'shipping_address'  =>$Shipping_address[0]->address_line_1. $Shipping_address[0]->address_line_2.','.$Shipping_address[0]->city.','.$Shipping_address[0]->state_name.', ('.$Shipping_address[0]->zip_code.')'.  $Shipping_address[0]->country_name.', '.'Contact No:-'.$Shipping_address[0]->phone,
          'carrier_id'       =>$shipping_rates->carrier_id,
          'payment_status'   =>1,
          'payment_method_id'=>$_POST['payment_type_id'],
          'order_status_id'  =>1,
          'approved'         =>1,

        );  
       /* $id=DB::table('orders')->insertGetId($data);*/

        /*print_r($input);*/

        $id=Order::create($data);

         //event(new OrderCreated($id));

        $id_data = Order::find($id);

        if($_POST['balance_use'] > 0){

            DB::table('sf_wallet')->where('cust_id',$_POST['customer_id'])->decrement('wallet_amnt', $_POST['balance_use']);

           $amount_after=DB::table('sf_wallet')->where('cust_id',$_POST['customer_id'])->first();
            $transaction=array(
              'cust_id'       =>$_POST['customer_id'],
              'amount'        =>$_POST['balance_use'],
              'amount_after'  =>$amount_after->wallet_amnt,
              'type'          =>'debit',
              'order_id'      => $id_data[0]->id,
              'transaction_id'=>rand(1, 9999999999),
              'remark'        =>'Promotional',
              'date'          =>new DateTime(),
            );
            \DB::table('sf_wallet_transaction')->insert($transaction);
        }
      $item = [];
      foreach ($order_items as $order) {
            $inventory =DB::table('inventories')->where('product_id', $order->product_id)->first();

          DB::table('inventories')->where('product_id', $order->product_id)->decrement('stock_quantity', $order->quantity);

                $item[] = [
                'order_id'          => $id_data[0]->id,
                'inventory_id'      => $inventory->id,
                'item_description'  => $inventory->title.'-'.$inventory->brand,
                'quantity'          => $order->quantity,
                'unit_price'        => $inventory->sale_price,
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
                ];
      }
        \DB::table('order_items')->insert($item);
        //DB::table('order_items')->insert(['order_id'=>$order_id]);

        echo '{"Status":"success","message":"Order place SuccessFully","error":"000000"}';

        
        /*return redirect()->route('admin.order.order.index')->with('success', trans('messages.created', ['model' => $this->model_name]));*/
    }

    public function shipping_details(Request $request){

      $this->check($_POST['key']);

      $shipping_details=DB::table('shipping_zones')
                 ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
                 ->join('carriers', 'shipping_rates.carrier_id', '=', 'carriers.id')
                 ->select('shipping_rates.id','shipping_rates.name', 'shipping_rates.carrier_id','shipping_rates.based_on', DB::raw('round(shipping_rates.minimum) as minimum'),DB::raw('round(shipping_rates.maximum) as maximum'),DB::raw('round(shipping_rates.rate) as rate'),'shipping_rates.delivery_takes','carriers.name as carriersName')
                 ->where('shipping_zones.shop_id', '=',11)
                 ->get();

                 /*$data = [];
                foreach ($shipping_details as $row) {
                  $data=array(

                      'id'            =>$row->id,
                      'name'          =>$row->name,
                      'carrier_id'    =>$row->carrier_id,
                      'based_on'      =>$row->based_on,
                      'minimum'       =>round($row->minimum),
                      'maximum'       =>round($row->maximum),
                      'rate'          =>round($row->rate),
                      'delivery_takes'=>$row->delivery_takes,
                      'carriersName'  =>$row->carriersName
                 );
                }   */

       echo '{"Status":"success","message":"Shipping Details","error":"000000","data":'.json_encode($shipping_details).'}';
    }
}
