<?php

namespace App\Http\Controllers\Storefront;

use DB;
use Session;
use Carbon\Carbon;
use App\Page;
use App\Shop;
use App\Banner;
use App\Slider;
use App\Product;
use App\Category;
use App\Inventory;
use App\Manufacturer;
use App\CategoryGroup;
use App\CategorySubGroup;
use App\ShopCategory;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        // dd("Hello world");
        // // $sliders = Slider::with('featuredImage:path,imageable_id,imageable_type')->orderBy('order', 'asc')->get()->toArray();
        // // $banners = Banner::with('featuredImage:path,imageable_id,imageable_type', 'images:path,imageable_id,imageable_type')
        // // ->orderBy('order', 'asc')->get()->groupBy('group_id')->toArray();

        // // $trending = ListHelper::popular_items(config('system.popular.period.trending', 2), config('system.popular.take.trending', 15));
        // // $weekly_popular = ListHelper::popular_items(config('system.popular.period.weekly', 7), config('system.popular.take.weekly', 5));

        // // $recent = ListHelper::latest_available_items(10);
        // // $additional_items = ListHelper::random_items(10);

        // return view('index');
    }

    /**
     * Browse category based products
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function browseCategory(Request $request, $slug, $sortby = Null)
    {
        // $category = Category::where('slug', $slug)->with(['subGroup' => function($q){
        //     $q->select(['id','slug','name','category_group_id'])->active();
        // }, 'subGroup.group' => function($q){
        //     $q->select(['id','slug','name'])->active();
        // }])->active()->firstOrFail();

        // // Take only available items
        // $all_products = $category->listings()->available();

        // // Parameter for filter options
        // $brands = ListHelper::get_unique_brand_names_from_linstings($all_products);
        // $priceRange = ListHelper::get_price_ranges_from_linstings($all_products);

        // // Filter results
        // $products = $all_products->filter($request->all())
        // ->withCount(['feedbacks', 'orders' => function($query){
        //     $query->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
        // }])
        // ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])
        // ->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));

        // return view('category', compact('category', 'products', 'brands', 'priceRange'));
    }

    /**
     * Browse listings by category sub group
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function browseCategorySubGrp(Request $request, $slug, $sortby = Null)
    {
        $categorySubGroup = CategorySubGroup::where('slug', $slug)->with(['categories' => function($q){
            $q->select(['id','slug','category_sub_group_id','name'])->whereHas('listings')->active();
        }])->active()->firstOrFail();

        $categories = $categorySubGroup->categories;

        $all_products = prepareFilteredListings($request, $categorySubGroup);

        // Get brands ans price ranges
        $brands = ListHelper::get_unique_brand_names_from_linstings($all_products);
        $priceRange = ListHelper::get_price_ranges_from_linstings($all_products);

        // Paginate the results
        $products = $all_products->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));

        return view('category_sub_group', compact('categorySubGroup', 'categories', 'products', 'brands', 'priceRange'));
    }

    /**
     * Browse listings by category group
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function browseCategoryGroup(Request $request, $slug, $sortby = Null)
    {
        // $categoryGroup = CategoryGroup::where('slug', $slug)->with(['categories' => function($q){
        //     $q->select(['categories.id','categories.slug','categories.category_sub_group_id','categories.name'])
        //     ->where('categories.active', 1)->whereHas('listings')->withCount('listings');
        // }])->active()->firstOrFail();

        // $categories = $categoryGroup->categories;

        // $all_products = prepareFilteredListings($request, $categoryGroup);

        // // Get brands ans price ranges
        // $brands = ListHelper::get_unique_brand_names_from_linstings($all_products);
        // $priceRange = ListHelper::get_price_ranges_from_linstings($all_products);

        // // Paginate the results
        // $products = $all_products->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));

        // return view('category_group', compact('categoryGroup', 'categories', 'products', 'brands', 'priceRange'));
    }

    /**
     * Open product page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function product($slug)
    {
        $item = Inventory::where('slug', $slug)->withCount('feedbacks')->firstOrFail();
        $shop = $item->shop;
        $item->load(['product' => function($q){
                $q->select('id', 'slug', 'description', 'manufacturer_id')
                ->withCount(['inventories' => function($query){
                    $query->available();
                }]);
            }, 'attributeValues' => function($q){
                $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')->with('attribute:id,name,attribute_type_id,order');
            },
            'feedbacks.customer:id,nice_name,name',
            'images:path,imageable_id,imageable_type',
        ]);

            $result=DB::table('product_visit_count')->where(['inventories_id'=>$item->id,'shop_id'=>$item->shop_id])->whereDate('created_at', \Carbon\Carbon::today())->get();
          
            if (count($result) > 0) {
                DB::table('product_visit_count')->where('visit_id', $result[0]->visit_id)->increment('hits', 1,['updated_at' => Carbon::now()]);
            }else{

               $data=array(
                'inventories_id'=>$item->id,
                'shop_id'       =>$item->shop_id,
                'hits'          =>1,
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
                 );
              DB::table('product_visit_count')->insert($data); 
            }
            

        $this->update_recently_viewed_items($item); //update_recently_viewed_items

        $variants = ListHelper::variants_of_product($item, $item->shop_id);

        $attr_pivots = \DB::table('attribute_inventory')->select('attribute_id','inventory_id','attribute_value_id')
        ->whereIn('inventory_id', $variants->pluck('id'))->get();

        $item_attrs = $attr_pivots->where('inventory_id', $item->id)->pluck('attribute_value_id')->toArray();

        $attributes = \App\Attribute::select('id','name','attribute_type_id','order')
        ->whereIn('id', $attr_pivots->pluck('attribute_id'))
        ->with(['attributeValues' => function($query) use ($attr_pivots) {
            $query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
        }])->orderBy('order')->get();

        $variants = $variants->toJson(JSON_HEX_QUOT);

        // TEST
        $related = ListHelper::related_products($item);
        $linked_items = ListHelper::linked_items($item);

        if( ! $linked_items->count() )
            $linked_items = $related->random($related->count() >= 3 ? 3 : $related->count());

        $geoip = geoip(request()->ip()); // Set the location of the user
        $countries = ListHelper::countries(); // Country list for shop_to dropdown

        return view('product', compact('item', 'variants', 'attributes', 'item_attrs', 'related', 'linked_items', 'geoip', 'countries','shop'));
    }

    public function simple_product($slug)
    {
        // $item = Inventory::where('slug', $slug)->available()->withCount('feedbacks')->firstOrFail();

        // $item->load(['product' => function($q){
        //         $q->select('id', 'slug', 'description', 'manufacturer_id')
        //         ->withCount(['inventories' => function($query){
        //             $query->available();
        //         }]);
        //     }, 'attributeValues' => function($q){
        //         $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')->with('attribute:id,name,attribute_type_id,order');
        //     },
        //     'feedbacks.customer:id,nice_name,name',
        //     'images:path,imageable_id,imageable_type',
        // ]);

        // $this->update_recently_viewed_items($item); //update_recently_viewed_items

        // $variants = ListHelper::variants_of_product($item, $item->shop_id);

        // $attr_pivots = \DB::table('attribute_inventory')->select('attribute_id','inventory_id','attribute_value_id')
        // ->whereIn('inventory_id', $variants->pluck('id'))->get();

        // $item_attrs = $attr_pivots->where('inventory_id', $item->id)->pluck('attribute_value_id')->toArray();

        // $attributes = \App\Attribute::select('id','name','attribute_type_id','order')
        // ->whereIn('id', $attr_pivots->pluck('attribute_id'))
        // ->with(['attributeValues' => function($query) use ($attr_pivots) {
        //     $query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
        // }])->orderBy('order')->get();

        // $variants = $variants->toJson(JSON_HEX_QUOT);

        // // TEST
        // $related = ListHelper::related_products($item);
        // $linked_items = ListHelper::linked_items($item);

        // if( ! $linked_items->count() )
        //     $linked_items = $related->random($related->count() >= 3 ? 3 : $related->count());

        // $geoip = geoip(request()->ip()); // Set the location of the user
        // $countries = ListHelper::countries(); // Country list for shop_to dropdown
        // $set=$item->set_size;
        // $pp=floor($item->sale_price);
        // $total=@($pp/$set);
        // $item['sale_price']=$total;
        // $item['set_size']=1;
        // $item['set_desc']='One Piece';

        // return view('product', compact('item', 'variants', 'attributes', 'item_attrs', 'related', 'linked_items', 'geoip', 'countries'));
    }

    /**
     * Open product quick review modal
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function quickViewItem($slug)
    {
        // $item = Inventory::where('slug', $slug)->available()
        // ->with([
        //     'images:path,imageable_id,imageable_type',
        //     'product' => function($q){
        //         $q->select('id', 'slug')
        //         ->withCount(['inventories' => function($query){
        //             $query->available();
        //         }]);
        //     },
        //     'attributeValues' => function($q){
        //         $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')->with('attribute:id,name,attribute_type_id');
        //     },
        // ])
        // ->withCount('feedbacks')->firstOrFail();

        // $this->update_recently_viewed_items($item); //update_recently_viewed_items

        // return view('modals.quickview', compact('item'))->render();
    }

    /**
     * Open shop page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function offers($slug)
    {
        // $product = Product::where('slug', $slug)->with(['inventories' => function($q){
        //         $q->available();
        //     }, 'inventories.attributeValues.attribute',
        //     'inventories.feedbacks:rating,feedbackable_id,feedbackable_type',
        //     'inventories.shop.feedbacks:rating,feedbackable_id,feedbackable_type',
        //     'inventories.shop.image:path,imageable_id,imageable_type',
        // ])->firstOrFail();

        // return view('offers', compact('product'));
    }

    /**
     * Open shop page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function shop($slug)
    {


        $shop = Shop::select('id','name','slug','description')->where('slug', $slug)->firstOrFail();
      
        $shop = Shop::where('slug', $slug)
      
        ->with(['feedbacks' => function($q){
            $q->with('customer:id,nice_name,name')->latest()->take(10);
        }])
        ->withCount(['inventories'])->firstOrFail();

        $shop_category= ShopCategory::where('shop_id',$shop->id)->first();
        $cat_subGroupId=$shop_category->category_sub_group_id;
        $cat_subGroupId=json_decode($cat_subGroupId);

    
         Session::put('shop',$shop);
    
        $shop->increment('store_visit_count');
        // Check shop maintenance_mode
        if(getShopConfig($shop->id, 'maintenance_mode'))
            return response()->view('errors.503', [], 503);

        $products = Inventory::where('shop_id', $shop->id)->filter(request()->all())
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])
        ->withCount(['orders' => function($q){
            $q->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
        }])
        ->paginate(8);
        
         $countries = ListHelper::countries(); // Country list for shop_to dropdown
         $geoip = geoip(request()->ip()); // Set the location of the user

        $trending = Inventory::where('shop_id', $shop->id)->select('id','slug','title','condition','sale_price','offer_price','offer_start','offer_end','stuff_pick','set_size','set_desc','stock_quantity')
        ->withCount(['orders' => function($q){
            $q->withArchived();
        }])->orderBy('orders_count', 'desc')
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->limit(10)->get();

         $banners = Banner::with('featuredImage:path,imageable_id,imageable_type', 'images:path,imageable_id,imageable_type')
         ->orderBy('order', 'asc')->get()->groupBy('group_id')->toArray();
     

        $recent = Inventory::where('shop_id', $shop->id)->select('id','slug','title','condition','sale_price','offer_price','offer_start','offer_end','set_size','set_desc','stock_quantity')
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->latest()->limit(10)->get();

        $additional_items = Inventory::where('shop_id', $shop->id)->select('id','slug','title','condition','sale_price','offer_price','offer_start','offer_end','set_size','set_desc','stock_quantity')
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->inRandomOrder()->limit(10)->get();

        $weekly_popular = Inventory::where('shop_id', $shop->id)->select('id','slug','title','condition','sale_price','offer_price','offer_start','offer_end','stuff_pick','set_size','set_desc','stock_quantity')
            ->withCount(['orders' => function($q){
            $q->withArchived();
        }])->orderBy('orders_count', 'desc')
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->limit(5)->get();
        return view('shop',compact('shop','banners','cat_subGroupId','products','trending','recent','additional_items','weekly_popular','geoip','countries'));
       
    }

    /**
     * Open brand page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function brand($slug)
    {
        // $brand = Manufacturer::where('slug', $slug)->firstOrFail();

        // $ids = Product::where('manufacturer_id', $brand->id)->pluck('id');

        // $products = Inventory::whereIn('product_id', $ids)->filter(request()->all())
        // ->whereHas('shop', function($q) {
        //     $q->select(['id', 'current_billing_plan', 'active'])->active();
        // })
        // ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])
        // ->withCount(['orders' => function($q){
        //     $q->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
        // }])
        // ->active()->paginate(20);

        // return view('brand', compact('brand', 'products'));
    }

    /**
     * Display the category list page.
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        // return view('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function openPage($slug)
    {
        // $page = Page::where('slug', $slug)->firstOrFail();

        // return view('page', compact('page'));
    }

    /**
     * Change Language
     *
     * @param  string $locale
     *
     * @return \Illuminate\Http\Response
     */
    public function changeLanguage($locale = 'en')
    {
        // Session::put('locale', $locale);

        // return redirect()->back();
    }

    /**
     * Push product ID to session for the recently viewed items section
     *
     * @param  [type] $item [description]
     */
    private function update_recently_viewed_items($item)
    {
        // $items = Session::get('products.recently_viewed_items', []);

        // if( ! in_array($item->getKey(), $items) )
        //     Session::push('products.recently_viewed_items', $item->getKey());

        // return;
    }
}
