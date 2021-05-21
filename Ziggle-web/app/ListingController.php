<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Wishlist;
use App\Shop;
use App\Order;
use App\Attribute;
use App\Product;
use App\Category;
use App\Inventory;
use App\Dispute;
use App\Bank;
use App\Manufacturer;
use Carbon\Carbon;
use App\CategoryGroup;
use App\CategorySubGroup;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemLightResource;
use App\Http\Resources\ListingResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\ShopListingResource;
use App\Http\Resources\ManufacturerResource;
use App\Http\Resources\ShippingOptionResource;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Builder;

class ListingController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($list = 'latest')
    {
    	switch ($list) {
    		case 'trending':
        		$listings = ListHelper::popular_items(config('mobile_app.popular.period.trending', 2), config('mobile_app.popular.take.trending', 8));
    			break;

    		case 'popular':
		        $listings = ListHelper::popular_items(config('mobile_app.popular.period.weekly', 7), config('mobile_app.popular.take.weekly', 8));
    			break;

    		case 'random':
		        $listings = ListHelper::random_items(Null);
    			break;

    		case 'latest':
    		default:
		        $listings = ListHelper::latest_available_items(8);
    			break;
    	}

        return ListingResource::collection($listings);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request,$term)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {  
        $products = Inventory::search($term)->where('active', 1)->get();
        $products->load(['shop:id,current_billing_plan,active']);

        // Keep results only from active shops
        $products = $products->filter(function ($product) {
            return ($product->shop->current_billing_plan !== Null) && ($product->shop->active == 1);
        });

        $products = $products->where('stock_quantity', '>', 0)->where('available_from', '<=', Carbon::now());

        if(request()->has('free_shipping')) {
            $products = $products->where('free_shipping', 1);
        }

        if(request()->has('new_arrivals')) {
            $products = $products->where('created_at', '>', Carbon::now()->subDays(config('mobile_app.filter.new_arrival', 7)));
        }

        if(request()->has('has_offers')) {
            $products = $products->where('offer_price', '>', 0)
            ->where('offer_start', '<', Carbon::now())
            ->where('offer_end', '>', Carbon::now());
        }

        if(request()->has('condition')) {
            $products = $products->whereIn('condition', array_keys(request()->input('condition')));
        }

        if(request()->has('price')) {
            $price = explode('-', request()->input('price'));
            $products = $products->where('sale_price', '>=', $price[0])->where('sale_price', '<=', $price[1]);
        }

        $products = $products->paginate(config('mobile_app.view_listing_per_page', 8));
        
         return ListingResource::collection($products);
         // return $this->processResponse('data',$listings,'success','Listings show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');

    }

    /**
     * Display a listing of the resource.
     *
     * @param  str $slug item_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function item(Request $request, $slug)
    {
        if($request->auth_code == null)
        {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {
        $item = Inventory::where('slug', $slug)->available()->withCount('feedbacks')->firstOrFail();

        $item->load(['product' => function($q){
                $q->select('id', 'name', 'slug', 'model_number', 'brand', 'mpn', 'gtin', 'gtin_type', 'description', 'origin_country', 'manufacturer_id', 'created_at')
                ->withCount(['inventories' => function($query){
                    $query->available();
                }]);
            },
            'attributeValues' => function($q){
                $q->select('id', 'attribute_values.attribute_id', 'value', 'order')
                ->with('attribute:id,name,attribute_type_id,order')->orderBy('order');
            },
            'feedbacks.customer:id,nice_name,name',
            'feedbacks.customer.image:path,imageable_id,imageable_type',
            'image:id,path,imageable_id,imageable_type',
        ]);

        $variants = Inventory::select(['id'])
        ->where(['product_id' => $item->product_id, 'shop_id' => $item->shop_id])
        ->with(['images', 'attributes.attributeType', 'attributeValues'])->available()->get();

        $attrs = $variants->pluck('attributes')->flatten(1)->toArray();
        $attrVs = $variants->pluck('attributeValues')->flatten(1)->toArray();

        $tempArr = [];
        foreach ($attrs as $key => $attr) {
            $tempArr[] = [
                'id' => $attr['id'],
                'type' => $attr['attribute_type']['type'],
                'name' => $attr['name'],
                'value' => [
                    'id' => $attrVs[$key]['id'],
                    'name' => $attrVs[$key]['value']
                ],
            ];
        }
        
        $uniqueAttrs = array_unique($tempArr, SORT_REGULAR);
         $attributes = array();
        foreach ($uniqueAttrs as $attr) {
            if($attr['name'] == 'Size')
            {
                $attributes[] = array(
                    'id'=>$attr['value']['id'],
                    'name'=>$attr['value']['name']
                );
            //    $attributes[$attr['id']]['name'] = $attr['name'];
            //    $attributes[$attr['id']]['value'][$attr['value']['id']] = $attr['value']['name'];
            }
        }
        
        // Shipping Zone
        $geoip = geoip(request()->ip()); // Set the location of the user
        $shipping_country_id = get_id_of_model('countries', 'iso_code', $geoip->iso_code);

        return (new ItemResource($item))->additional(['variants' => [
                    'images' => ImageResource::collection($variants->pluck('images')->flatten(1)),
                    'attributes' => $attributes,
                ],
                'shipping_country_id' => $shipping_country_id,
                'shipping_options' => $this->get_shipping_options($item, $shipping_country_id, $geoip->state),
               // 'countries' => ListHelper::countries(), // Country list for ship_to dropdown
            ]);
               //return $this->processResponse('Category_sub_group',$category_sub_groups,'success','Category Sub Group Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }
    else
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      {
        $item = Inventory::where('slug', $slug)->available()->withCount('feedbacks')->firstOrFail();

        $item->load(['product' => function($q){
                $q->select('id', 'name', 'slug', 'model_number', 'brand', 'mpn', 'gtin', 'gtin_type', 'description', 'origin_country', 'manufacturer_id', 'created_at')
                ->withCount(['inventories' => function($query){
                    $query->available();
                }]);
            },
            'attributeValues' => function($q){
                $q->select('id', 'attribute_values.attribute_id', 'value', 'order')
                ->with('attribute:id,name,attribute_type_id,order')->orderBy('order');
            },
            'feedbacks.customer:id,nice_name,name',
            'feedbacks.customer.image:path,imageable_id,imageable_type',
            'image:id,path,imageable_id,imageable_type',
        ]);

        $variants = Inventory::select(['id'])
        ->where(['product_id' => $item->product_id, 'shop_id' => $item->shop_id])
        ->with(['images', 'attributes.attributeType', 'attributeValues'])->available()->get();

        $attrs = $variants->pluck('attributes')->flatten(1)->toArray();
        $attrVs = $variants->pluck('attributeValues')->flatten(1)->toArray();

        $tempArr = [];
        foreach ($attrs as $key => $attr) {
            $tempArr[] = [
                'id' => $attr['id'],
                'type' => $attr['attribute_type']['type'],
                'name' => $attr['name'],
                'value' => [
                    'id' => $attrVs[$key]['id'],
                    'name' => $attrVs[$key]['value']
                ],
            ];
        }
        
        $uniqueAttrs = array_unique($tempArr, SORT_REGULAR);
         $attributes = array();
        foreach ($uniqueAttrs as $attr) {
            if($attr['name'] == 'Size')
            {
                $attributes[] = array(
                    'id'=>$attr['value']['id'],
                    'name'=>$attr['value']['name']
                );
            //    $attributes[$attr['id']]['name'] = $attr['name'];
            //    $attributes[$attr['id']]['value'][$attr['value']['id']] = $attr['value']['name'];
            }
        }
        
        // Shipping Zone
        $geoip = geoip(request()->ip()); // Set the location of the user
        $shipping_country_id = get_id_of_model('countries', 'iso_code', $geoip->iso_code);

        return (new ItemResource($item))->additional(['variants' => [
                    'images' => ImageResource::collection($variants->pluck('images')->flatten(1)),
                    'attributes' => $attributes,
                ],
                'shipping_country_id' => $shipping_country_id,
                'shipping_options' => $this->get_shipping_options($item, $shipping_country_id, $geoip->state),
               // 'countries' => ListHelper::countries(), // Country list for ship_to dropdown
            ]);
               //return $this->processResponse('Category_sub_group',$category_sub_groups,'success','Category Sub Group Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }
    }

    /**
     * Return shipping options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shipTo(Request $request, Inventory $item)
    {
        $shipping_options = $this->get_shipping_options($item, $request->country_id, $request->state_id);

        if(! $shipping_options) {
            return response()->json(['message' => trans('theme.notify.seller_doesnt_ship')], 404);
        }

        return response()->json([
            'shipping_options' => $shipping_options,
        ], 200);
    }

    /**
     * Display variant of an item
     *
     * @param  str $slug item_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function variant(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();

        // Take only available items
        $all_products = $category->listings()->available();

        // Filter results
        $listings = $all_products->filter(request()->all())
        ->withCount(['feedbacks', 'orders' => function($q){
            $q->withArchived();
        }])->with(['attributeValues' => function($q){
            $q->select('id', 'attribute_values.attribute_id', 'value', 'color')->groupBy('attribute_values.color');}])
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type,updated_at', 'image:path,imageable_id,imageable_type'])
        ->paginate(config('mobile_app.view_listing_per_page', 8))->appends(request()->except('page'));
      
        // $item = Inventory::where('slug', $slug)->available()->firstOrFail();

       
        // $attributes = $request->input('attributes');

        // $variants = Inventory::where(['product_id' => $item->product_id, 'shop_id' => $item->shop_id])
        // ->with(['attributeValues' => function($q){
        //     $q->select('id', 'attribute_values.attribute_id', 'value', 'color')->groupBy('attribute_values.color');
        // }])->available()->get();
        // foreach ($variants as $key => $variant) {
        //     foreach($variant->attributeValues as $data);
        //     {   
        //         if($data->attribute_id == 1)
        //         {
        //             $temp = array($data->value);
        //         }
        //     }
           
        //     if($attributes == null)
        //     {
        //         $attributes = array();
        //     }
        //     if(! (bool) array_diff($temp, $attributes)) {
        //         return new ItemLightResource($variant);
        //     }
        // }
        $new_listings = ListingResource::collection($listings);
        return response()->json(['Product_listings'=>$new_listings,'status'=>'success','message' => trans('api.item_not_in_stock')], 200);
    }


    public function variant_size(Request $request, $slug)
    {
        $item = Inventory::where('slug', $slug)->available()->firstOrFail();
       
        $attributes = $request->input('attributes');

        $variants = Inventory::where(['product_id' => $item->product_id, 'shop_id' => $item->shop_id])
        ->with(['attributeValues' => function($q){
            $q->select('id', 'attribute_values.attribute_id', 'value', 'color')->orderBy('attribute_values.attribute_id');
        }])->available()->get();

        foreach ($variants as $key => $variant) {
            foreach($variant->attributeValues as $data);
            {   
                if($data->attribute_id == 3)
                {
                    $temp = array($data->value);
                }
            }
           
            if($attributes == null)
            {
                $attributes = array();
            }
            if(! (bool) array_diff($temp, $attributes)) {
                $variant_size = new ItemLightResource($variant);
                return response()->json(['data'=>$variant_size,'message' => trans('api.item_available_in_stock'),'status'=>'success'], 200);
            }
        }

        return response()->json(['message' => trans('api.item_not_in_stock'),'status'=>'failed'], 404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  str $slug category_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryGroup($slug)
    {
        $categoryGroup = CategoryGroup::where('slug', $slug)->active()->firstOrFail();

        $all_products = prepareFilteredListings(request(), $categoryGroup);

        // Paginate the results
        $listings = $all_products->paginate(config('mobile_app.view_listing_per_page', 8))->appends(request()->except('page'));

        return ListingResource::collection($listings);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  str $slug category_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function categorySubGroup($slug)
    {
        $categorySubGroup = CategorySubGroup::where('slug', $slug)->active()->firstOrFail();

        $all_products = prepareFilteredListings(request(), $categorySubGroup);

        // Paginate the results
        $listings = $all_products->paginate(config('mobile_app.view_listing_per_page', 8))->appends(request()->except('page'));

        return ListingResource::collection($listings);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  str $slug category_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request , $slug)
    {
        if($request->auth_code == null)
        {
            $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
            if($cust_id)
          {
            $category = Category::where('slug', $slug)->active()->firstOrFail();
            $start=($request->page-1)*10;
            // Take only available items
            $all_products = $category->listings()->available();
    
            // Filter results
            $listings = $all_products->filter(request()->all())
            ->withCount(['feedbacks', 'orders' => function($q){
                $q->withArchived();
            }])->with(['attributeValues' => function($q){
                $q->select('id', 'attribute_values.attribute_id', 'value', 'color')->groupBy('attribute_values.color');}])
            ->with(['feedbacks:rating,feedbackable_id,feedbackable_type,updated_at', 'image:path,imageable_id,imageable_type'])
            ->offset($start)->take(10)->get();
    
           $list_of_products = ListingResource::collection($listings);
           
            return $this->processResponse('data',$list_of_products,'success','Category wise products show successfully!!');
        } 
        else
             return $this->processResponse(null,null,'error','Enter correct login details');
        }
        else
        {
            $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
            if($cust_id)
          {
            $category = Category::where('slug', $slug)->active()->firstOrFail();
    
            // Take only available items
            $all_products = $category->listings()->available();
    
            // Filter results
            $listings = $all_products->filter(request()->all())
            ->withCount(['feedbacks', 'orders' => function($q){
                $q->withArchived();
            }])->with(['attributeValues' => function($q){
                $q->select('id', 'attribute_values.attribute_id', 'value', 'color')->groupBy('attribute_values.color');}])
            ->with(['feedbacks:rating,feedbackable_id,feedbackable_type,updated_at', 'image:path,imageable_id,imageable_type'])
            ->with(['wishlist' => function($q) use ($cust_id){
                $q->where('customer_id','=',$cust_id->user_id);}])
            ->paginate(config('mobile_app.view_listing_per_page', 8))->appends(request()->except('page'));
    
           $list_of_products = ListingResource::collection($listings);
           
            return $this->processResponse('Product_listings',$list_of_products,'success','Category wise products show successfully!!');
        } 
        else
             return $this->processResponse(null,null,'error','Enter correct login details');
        }
    
    }

    /**
     * Display a listing of the shop.
     *
     * @param  str $slug shop_slug
     *
     * @return [type]       [description]
     */
    public function shop($slug)
    {
        $shop = Shop::where('slug', $slug)->active()
        ->withCount(['inventories' => function($q){
            $q->available();
        }])->firstOrFail();

        // Check shop maintenance_mode
        if($shop->isDown()) {
            return response()->json(['message' => trans('app.marketplace_down')], 404);
        }

        $listings = Inventory::where('shop_id', $shop->id)->filter(request()->all())
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type,updated_at', 'image:path,imageable_id,imageable_type'])
        ->withCount(['orders' => function($q){
            $q->withArchived();
        }])
        ->available()->paginate(config('mobile_app.view_listing_per_page', 10));

        return (new ShopListingResource($shop))->listings(ListingResource::collection($listings));
        // return ListingResource::collection($listings);
    }

    /**
     * Open brand page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function brand(Request $request,$id)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {
        $brand = Manufacturer::where('id', $id)->firstOrFail();
        $start=($request->page-1)*10;
        
        $ids = Product::where('manufacturer_id', $brand->id)->pluck('id');

        $listings = Inventory::whereIn('product_id', $ids)->filter(request()->all())
        ->whereHas('shop', function($q) {
            $q->select(['id', 'current_billing_plan', 'active'])->active();
        })
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type,updated_at', 'image:path,imageable_id,imageable_type'])
        ->withCount(['orders' => function($q){
            $q->withArchived();
        }])->groupBy('product_id')
        ->offset($start)->take(10)->active()->get();

        $listing = ListingResource::collection($listings);
        return $this->processResponse('data',$listing,'success','Brand wise products show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');

        // return ListingResource::collection($listings);
    }

    /**
     * Return available shipping options for the item
     *
     * @param  item  $item
     * @param  country_id  $country_id
     * @param  state_id  $state
     *
     * @return array|Null
     */
    private function get_shipping_options($item, $country_id, $state)
    {
        $zone = get_shipping_zone_of($item->shop_id, $country_id, $state);

        if(! $zone || is_a($zone, 'stdClass')) {
            return Null;
        }

        $free_shipping = [];
        if($item->free_shipping) {
            $free_shipping[] = getFreeShippingObject($zone);
        }

        $shipping_options = ShippingOptionResource::collection(
            filterShippingOptions($zone->id, $item->currnt_sale_price(), $item->shipping_weight)
        );

        return empty($free_shipping) ?
                $shipping_options : collect($free_shipping)->merge($shipping_options);
    }

    public function filter_list(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {  
        $attribute_id = Attribute::select('id')->where('name','Size')->first();
        $attribute_id = $attribute_id->id;
        
        $sizes = Attribute::with(['attributeValues' => function($q) use ($attribute_id){
            $q->select('id', 'attribute_values.attribute_id', 'value')->where('attribute_values.attribute_id',$attribute_id);}])->where('attribute_type_id','=',3)->get();
        
        $attribute_color_id = Attribute::select('id')->where('name','Color')->first();
        $attribute_color_id = $attribute_color_id->id;
        $colors = Attribute::with(['attributeValues' => function($q) use ($attribute_color_id){
            $q->select('id', 'attribute_values.attribute_id', 'value')->where('attribute_values.attribute_id',$attribute_color_id);}])->where('attribute_type_id','=',1)->get();
            
        $brands = Manufacturer::with(['image:path,imageable_id,imageable_type'])->get();
       
        $price_range = Inventory::select('sale_price')->orderBy('sale_price','desc')->limit(1)->get();
        
        $filter = array(
            'size'=>$sizes,
            'color'=>$colors,
            'brands'=>$brands,
            'sale_price'=>$price_range
        );

        return $this->processResponse('Filter_list',$filter,'success','Filter show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    public function filter_store(Request $request,$slug)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {  
        $max_price_default = Product::select('min_price')->orderBy('min_price','desc')->limit(1)->first();
        $category = Category::select('id')->where('slug', $slug)->active()->firstOrFail();
        $start=($request->page-1)*10;
        // Take only available items
        $product_id = array();
        $all_products = $category->products;
        foreach($all_products as $product)
        {
            $product_id[] = $product->id;
        }
       
         if($request->min_price == null)
          {
            $min_price = 0;
          }
          else
          {
            $min_price = $request->min_price;
          }

          if($request->max_price == null)
          {
            $max_price = $max_price_default->min_price;
          }
          else
          {
            $max_price = $request->max_price;
          }
          $attr = json_decode($request->attr,true);
         
          $brand = json_decode($request->brand , true);

            if(count($brand) < 1)
            {
                $ids = Product::pluck('id');
            }
            else
            {
                $ids = Product::whereIn('manufacturer_id', $brand)->pluck('id');
            }
        if($attr == null)
        {
                $listings = Product::whereIn('id',$product_id)->with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                    $query->available();
                }])->having('inventories_count', '>', 2)->limit(10)->get();
        }
        else
        {
            $listings = Product::with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                $query->available();
            }])->having('inventories_count', '>', 2)->limit(10)->get();
        }
        return $listings;
        $p = array();
        foreach($listings as $key)
        {
           $p[$key->id]= $key; 
        }
        
        $response = array();
        foreach($p as $key)
        {
            array_push($response,$key);
        }
    
     
        //$list =  ListingResource::collection($response);
        return $this->processResponse('data',$response_array,'success','Filter data show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    public function order_status(Request $request,$order)
    {    
        $order = Order::find($order);
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      { 
        $order_log = DB::table('activity_log')->select('*')->where('subject_id',$order->id)->whereNotNull('causer_id')->where('subject_type','App\Order')->get();
        $p = array("order_id"=>$order->id,"created_at"=>$order->created_at,"name"=>'Pending');
        $arr = array();
        array_push($arr,$p);
        
        foreach ($order_log as $log) {
            $json=json_decode($log->properties,true);
            if(array_key_exists('order_status_id', $json['attributes'])){
                $status=$json['attributes']['order_status_id'];
                $statusName = DB::table('order_statuses')->select('name')->where('id',$status)->first();
                if($statusName == null)
                {
                    $name = 'No Status';
                }
                else
                {
                    $name = $statusName->name;
                }
                array_push($arr, array("order_status_id"=>$order->order_status_id,"order_id"=>$order->id,"created_at"=>$log->created_at,"name"=>$name));
            }
        }
        return $this->processResponse('data',$arr,'success','Order status show successfully!!');
      } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');    
    }

    public function dispute_status(Request $request,$dispute)
    {    
        $dispute = Dispute::find($dispute);
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      { 
        $order_log = DB::table('activity_log')->select('*')->where('subject_id',$dispute->id)->where('subject_type','App\Dispute')->get();
        $arr = array();
        foreach ($order_log as $log) {
            $json=json_decode($log->properties,true);
            if(array_key_exists('order_id', $json['attributes'])){
                $status=$json['attributes']['order_id'];
                $order_id = Order::find($status);
                $statusName = DB::table('order_statuses')->select('name')->where('id',$order_id->order_status_id)->first();
                if($statusName == null)
                {
                    $name = 'No Status';
                }
                else
                {
                    $name = $statusName->name;
                }
                array_push($arr, array("order_id"=>$order_id->id,"created_at"=>$log->created_at,"name"=>$name));
            }
        }
        return $this->processResponse('data',$arr,'success','Dispute status show successfully!!');
      } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');    
    }

    public function sorting(Request $request,$slug)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {  
        $start = ($request->page - 1) * 10;
        switch($request->type)
        {
            case 'lowTohigh':
                $products = Product::with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                    $query->available();
                }])->having('inventories_count', '>', 2)->orderBy('min_price')->offset($start)->take(5)->get();
    
                $product_resource =ProductResource::collection($products);
                return $this->processResponse('data',$product_resource,'success','Products show successfully!!');
            break;
            case 'highTolow':
                $products = Product::with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                    $query->available();
                }])->having('inventories_count', '>', 2)->orderBy('min_price','desc')->offset($start)->take(5)->get();
    
                $product_resource =ProductResource::collection($products);
                return $this->processResponse('data',$product_resource,'success','Products show successfully!!');
            break;
            case 'new_arrivals':
                $products = Product::with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                    $query->available();
                }])->having('inventories_count', '>', 2)->orderBy('created_at','desc')->offset($start)->take(5)->get();
    
                $product_resource =ProductResource::collection($products);
                return $this->processResponse('data',$product_resource,'success','Products show successfully!!');
            break;
        }

    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');    
    }

    public function category_products(Request $request,$category)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $start=($request->page-1)*10;
            $products = Product::join('category_product','products.id','=','category_product.product_id')->with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
                $query->available();
            }])->where('category_product.category_id',$category)->having('inventories_count', '>', 2)->offset($start)->take(10)->get();;

            $product_resource = ProductResource::collection($products);
            
    
        return $this->processResponse('data',$product_resource,'success','Products show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function check_image_upload(Request $request)
    {
        //$this->validate($_POST['key']);
        $path='/var/www/ziggle.in/';
       // $path='C;/';
       // file_put_contents($path.'/public/uploads/log.txt', $request->check_image);
        $folderPath = $path.'public/image/images/';
        $image= $request->check_image;
        $check_image = str_replace('data:image/jpeg.base64,', '', $image);
        $check_image=str_replace(' ', '+', $check_image);
        $data = base64_decode($check_image);
        $unique_id=uniqid();
        $image=$unique_id.'.jpeg';
        $file = $folderPath .$image;
        $success = file_put_contents($file, $data);
        $data = $image;       
        return $this->processResponse('check_image',$data,'success','Check image upload successfully!!');
    }
    
    public function bank_details(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
        {
            $bank = new Bank;
            $bank->customer_id = $cust_id->user_id;
            $bank->account_no = $request->account_no;
            $bank->account_holder_name = $request->account_holder_name;
            $bank->ifsc_code = $request->ifsc_code;
            $bank->image = $request->image;
            $bank->save();
    
        return $this->processResponse(null,null,'success','Bank details saved successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    public function test(Request $request)
    {
        $message = ' Order Shipped Successfully , Please Check out the App';
        $types = 'promotion';
        $tp = $request->cust_id;
        $chat = 'Hurry!! New Loan Product is here.';
        $this->notify($tp,$chat,$message,$types);
    }
}