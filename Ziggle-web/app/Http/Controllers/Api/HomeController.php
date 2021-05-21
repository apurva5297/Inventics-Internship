<?php

namespace App\Http\Controllers\Api;

use App\Catalog;
use App\Cart;
use App\Page;
use App\Shop;
use App\Referral;
use Carbon\Carbon;
use App\Banner;
use App\Slider;
use App\State;
use App\Blog;
use App\City;
use App\Product;
use App\Customer;
use App\Inventory;
use App\Feedback;
use App\Country;
use App\Manufacturer;
use App\CategorySubGroup;
use App\ShippingRate;
use App\SharedCatalog;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopLightResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\PackagingResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\ManufacturerResource;
use App\Http\Resources\CategorySubGroupResource;

use App\Http\Resources\ListingResource;
use App\Http\Resources\ShippingOptionResource;
use App\Http\Requests\Validations\ShippingOptionRequest;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;

class HomeController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sliders(Request $request)
    {
     $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $sliders = Slider::whereHas('mobile')->with('mobile')->get();

            $sliders = SliderResource::collection($sliders);

            return $this->processResponse('Sliders',$sliders,'success','sliders Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banners(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
        $banners = Banner::with(['bannerbg', 'featuredImage'])->get();
        $banners = BannerResource::collection($banners);
        return $this->processResponse('Banners',$banners,'success','Banners Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Open offers page for the item
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function offers($slug)
    {
        $product = Product::where('slug', $slug)->with(['inventories' => function($q){
                $q->available();
            }, 'inventories.attributeValues.attribute',
            'inventories.feedbacks',
        ])->firstOrFail();

        return new OfferResource($product);
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allShops(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
        $shops = Shop::active()->get();
        $shop = ShopLightResource::collection($shops);

        return $this->processResponse('Shops',$shop,'success','Shops Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function shop(Request $request,$slug)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
        $shop = Shop::where('slug', $slug)->active()
        ->with(['feedbacks' => function($q){
            $q->with('customer:id,nice_name,name')->latest()->take(10);
        }])
        ->withCount(['inventories' => function($q){
            $q->available();
        }])->firstOrFail();

        // Check shop maintenance_mode
        if($shop->isDown()) {
            return response()->json(['message' => trans('app.marketplace_down')], 404);
        }

        $shop_details = new ShopResource($shop);
        return $this->processResponse('Shop_details',$shop_details,'success','Shops Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');

    }

    /**
     * Return available packaging options for the specified shop.
     *
     * @param  str  $shop
     * @return \Illuminate\Http\Response
     */
    public function packaging($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();
        $platformDefaultPackaging = new PackagingResource(getPlatformDefaultPackaging());
        $packagings = PackagingResource::collection($shop->activePackagings);

        return $packagings->prepend($platformDefaultPackaging);
        // return new PackagingResource($platformDefaultPackaging);
        // return PackagingResource::collection($shop->activePackagings);
    }

    /**
     * Return available shipping options for the specified shop.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str  $shop
     * @return \Illuminate\Http\Response
     */
    public function shipping(ShippingOptionRequest $request, Shop $shop)
    {
        $shippingOptions = ShippingRate::where('shipping_zone_id', $request->zone)->with('carrier:id,name')->get();

        return ShippingOptionResource::collection($shippingOptions);
    }

    /**
     * Return available payment options options for the specified shop.
     *
     * @param  str  $shop
     * @return \Illuminate\Http\Response
     */
    public function paymentOptions($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();

        $paymentMethods = $shop->paymentMethods;
        $activeManualPaymentMethods = $shop->config->manualPaymentMethods;
        foreach ($paymentMethods as $key => $payment_provider) {
            $has_config = FALSE;
            switch ($payment_provider->code) {
                case 'stripe':
                  $has_config = $shop->config->stripe ? TRUE : FALSE;
                  // $info = trans('theme.notify.we_dont_save_card_info');
                  break;

                case 'instamojo':
                  $has_config = $shop->config->instamojo ? TRUE : FALSE;
                  // $info = trans('theme.notify.you_will_be_redirected_to_instamojo');
                  break;

                case 'authorize-net':
                  $has_config = $shop->config->authorizeNet ? TRUE : FALSE;
                  // $info = trans('theme.notify.we_dont_save_card_info');
                  break;

                case 'paypal-express':
                  $has_config = $shop->config->paypalExpress ? TRUE : FALSE;
                  // $info = trans('theme.notify.you_will_be_redirected_to_paypal');
                  break;

                case 'paystack':
                  $has_config = $shop->config->paystack ? TRUE : FALSE;
                  // $info = trans('theme.notify.you_will_be_redirected_to_paystack');
                  break;

                case 'wire':
                case 'cod':
                    $has_config = in_array($payment_provider->id, $activeManualPaymentMethods->pluck('id')->toArray()) ? TRUE : FALSE;
                    // $temp = $activeManualPaymentMethods->where('id', $payment_provider->id)->first();
                    // $info = $temp ? $temp->pivot->additional_details : '';
                    break;

                default:
                  $has_config = FALSE;
                  break;
            }

            if( ! $has_config ) {
                $paymentMethods->forget($key);
            }
        }

        return PaymentMethodResource::collection($paymentMethods);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
        $countries = Country::select('id','name','iso_code')->get();
        $country = CountryResource::collection($countries);
        
        return $this->processResponse('Countries',$country,'success','Countries Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $country
     * @return \Illuminate\Http\Response
     */
    public function states(Request $request,$country)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $states = State::select('id','name','iso_code')->where('country_id', $country)->get();
            $state = StateResource::collection($states);

        return $this->processResponse('States',$state,'success','States Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function page(Request $request,$slug)
    {
     $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
     if($cust_id)
        {
        $page = Page::where('slug', $slug)->firstOrFail();
        $pages =  new PageResource($page);
        
        return $this->processResponse('Pages',$pages,'success','Pages Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function city(Request $request,$state)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $states = City::select('city_id','city_name','pincode')->where('state_id', $state)->get();
            $state = CityResource::collection($states);

        return $this->processResponse('States',$state,'success','States Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function home(Request $request,$group = 3)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
           {
               //Sub Category
                if($group){
                    $categories = CategorySubGroup::where('category_group_id', $group)
                    ->with(['featuredImage'])->active()->get();
                }
                else{
                    $categories = CategorySubGroup::with(['featuredImage'])->active()->get();
                }
        
                $category_sub_groups = CategorySubGroupResource::collection($categories);

                $sliders = Slider::whereHas('mobile')->with('mobile')->get();
                $slider = SliderResource::collection($sliders);
                
                $home_page = array(
                    'sub_categories'=>$category_sub_groups,
                    'sliders'=>$slider,
                );

                return $this->processResponse('Home_page',$home_page,'success','HomePage Show Successfully!!');
            } 
       else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function products(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $products = Product::join('catalog_product','products.id','=','catalog_product.product_id')->join('catalogs','catalogs.id','=','catalog_product.catalog_id')->with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                $query->available();
            }])
            ->having('inventories_count', '>', 2)->limit(10)->get();
            
            $product_resource = ProductResource::collection($products);
            
        return $this->processResponse('data',$product_resource,'success','Products show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function catalog_products(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            // $products = Product::join('catalog_product','products.id','=','catalog_product.product_id')->join('catalogs','catalogs.id','=','catalog_product.catalog_id')->with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
            //     $query->available();
            // }])
            // ->having('inventories_count', '>', 2)->limit(10)->get();
           
            $catalogs = Catalog::all();
            foreach($catalogs as $catalog)
            {
                $arr[] = array(
                        'cataog_id'=>$catalog->id,
                        'catalog_name'=> $catalog->catalog_name,
                        'catalog_price'=>$this->getProductsPrice($catalog->products),
                        'catalog_products'=>ProductResource::collection($catalog->products)
                );
            }
            //$product_resource = ProductResource::collection($products);
            
        return $this->processResponse('data',$arr,'success',' Catalog products show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

  
    public function getProductsPrice($products)
    {
        foreach($products as $product)
        {
           return $product->min_price;
        }
    }

    public function product_inventories(Request $request,$product_id)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
             $inventories = Inventory::where('product_id',$product_id)->with(['attributeValues' => function($q){
            $q->select('id', 'attribute_values.attribute_id', 'value', 'color')->groupBy('attribute_values.color');}])->get();

            $listings = ListingResource::collection($inventories);        
        
        return $this->processResponse('data',$listings,'success','Product inventories show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function count_cart_items(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
        {
          $count_items = Cart::join('cart_items','carts.id','=','cart_items.cart_id')
          ->select('item_count')
          ->where('customer_id',$cust_id->user_id)
          ->first(); 
        return $this->processResponse('data',$count_items,'success','Count cart show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function others(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
         $other = DB::table('pages')->get();

        return $this->processResponse('data',$other,'success','Other details show successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    public function shared_catalogs(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $shared_catalogs = new SharedCatalog;
            $shared_catalogs->product_id = $request->product_id;
            $shared_catalogs->customer_id = $cust_id->user_id;
            $shared_catalogs->save();

        return $this->processResponse(null,null,'success','Shared catalogs saved successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    public function shared_catalogs_show(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $start = ($request->page - 1) * 10;
            $shared_catalogs_show = SharedCatalog::where('customer_id',$cust_id->user_id)->get();
            $shared = array();
            foreach($shared_catalogs_show as $key)
            {
                $shared[] = $key->product_id;
            }
            $products = Product::whereIn('id',$shared)->with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                $query->available();
            }])->having('inventories_count', '>', 2)->offset($start)->take(5)->get();

            $shared_logs =ProductResource::collection($products);
        return $this->processResponse('data',$shared_logs,'success','Shared catalogs saved successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    public function business_card(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
         $customer = Customer::select('customers.*','countries.name as country_name','states.name as state_name','city_list.city_name as city_name')
         ->join('countries','customers.country_id','=','countries.id')
         ->join('states','states.country_id','=','countries.id')
         ->join('city_list','city_list.state_id','=','states.id')
         ->where('customers.id',$cust_id->user_id)->first();

        return $this->processResponse('data',$customer,'success','Business card details show successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');    
    }

    public function profile(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
         $customer = Customer::find($cust_id->user_id);

        return $this->processResponse('data',$customer,'success','Profile show successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');    
    }

    public function profile_update(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $customer = Customer::find($cust_id->user_id);
            $customer->name = $request->name;
            $customer->image = $request->image;
            $customer->business_name = $request->business_name;
            $customer->email = $request->email;
            $customer->sex = $request->gender;
            $customer->pin_code = $request->pin_code;
            $customer->city_id = $request->city_id;
            $customer->state_id = $request->state_id;
            $customer->save();

        return $this->processResponse(null,null,'success','Profile update successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');    
    }

    public function referals(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $referals = Referral::join('customers','refer_list.cuid','=','customers.id')
            ->select('customers.*','refer_list.cuid','refer_list.refered_by','refer_list.created_at','refer_list.total')
            ->where('refered_by',$cust_id->user_id)
            ->get();
           
            $refer = array();
            foreach($referals as $key)
            {
                $refer[] = array(
                    'name'=>$key->name,
                    'referal_date'=> date("d/m/Y", strtotime($key->created_at)),
                    'referee_amount'=>round(($key->total) * (10/100)) 
                );
            }
        return $this->processResponse('referals',$refer,'success','Referral list show successfully!!'); 
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');     
    }
}