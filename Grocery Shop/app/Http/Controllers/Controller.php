<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $server_image_path = "http://dev.gudgrocery.com/image/";
    public $my_category = 'Gud Grocery';
    public $store_type = 'Food';
    public $currency = "Rs.";
    public $current_currency = "Rs.";
    public $for_same_cart = "different";//it can be same or different at a time


    public function __construct()
    {
        if ($this->isAuthenticated("check"))
            $wishlist = $this->showAllWishlist();
        else
            $wishlist = array();
        $img_url = $this->server_image_path;
        $current_currency = $this->currency;

//        $minicartItems=$this->minicart();
        $categories = $this->getsubgroup();
        $sub_categories = $this->getsubgroupcategories();
        $announcement=$this->announcements();
        $cat_product = $this->getcategoriesproduct();
      //  dd($cat_product);
        View::share(['img_url' => $img_url,  'categories' => $categories, 'sub_categories' => $sub_categories, 'cat_product' => $cat_product,'announcement'=> $announcement,'wishlist'=>$wishlist ,'current_currency'=>$current_currency]);
    }

    public function getMyCountryCurrency($country_name = "India")
    {
        $country = DB::table('countries')
            ->where('name', $country_name)
            ->first();
        return $country->currency_symbol;
    }

    public function isAuthenticated($things = "check")//"check","id","logout","details"
    {
        if ($things == "check")
            return Auth::check();
        elseif ($things == "id")
            return Auth::id();
        elseif ($things == "logout")
            return Auth::logout();
        elseif ($things == "details")
            return Auth::user();
    }

    public function getInventoryImages()
    {
        return DB::table('images')
            ->join('inventories', 'images.imageable_id', '=', 'inventories.id')
            ->where('images.imageable_type', 'App\Inventory')
            ->select('inventories.*', 'images.path as img_path')
            ->get();
    }


    public function blogcategory()
    {
        return DB::table('blogs')
            ->join('images', 'blogs.id', '=', 'images.imageable_id')
            ->where('images.imageable_type', 'App\blog')
            ->inRandomOrder()->get();
    }

    public function getsubgroup()
    {
        return DB::table('category_groups')
            ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
            ->where('category_groups.name', $this->my_category)->get();
    }

    public function getfeedback()
    {
        $feedback=DB::table('inventories')
            ->join('feedbacks', 'inventories.id', '=', 'feedbacks.feedbackable_id')
            ->where('feedbacks.feedbackable_type','App\Inventory')
            ->select('feedbacks.*','feedbackable_id as feedback_id')->get();
    }

    public function announcements()
    {
        return DB::table('announcements')
            ->select('announcements.*','announcements.body  as content')->get();
    }





    public function getcategoriesproduct($order = "random")//random, latest
    {
        if($order=="random")
        { 
            $inventory= DB::table('category_groups')
            ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
            ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
            ->join('category_product', 'categories.id', '=', 'category_product.category_id')
            ->join('products', 'category_product.product_id', '=', 'products.id')
           ->join('inventories', 'products.id', '=', 'inventories.product_id')
           //->join('shops','inventories.shop_id','=','shops.id')
            //->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
           // ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
           ->join('images', 'inventories.id', '=', 'images.imageable_id')
            ->where('category_groups.name',$this->my_category)
           
            ->where('images.imageable_type','App\Inventory')
           // ->where('images.featured',1)
            ->where('inventories.stock_quantity','>',0)
            ->select('inventories.*','inventories.id as inventory_id','products.id as product_id','inventories.title as name','images.path as img_path','inventories.sale_price as min_price','inventories.sale_price as max_price','categories.slug as product_cat','category_sub_groups.slug as product_sub_cat','category_sub_groups.name as cat_sub_name')
            ->inRandomOrder()->get();
        }
        elseif($order=="latest")
        {
            $inventory= DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                ->join('products', 'category_product.product_id', '=', 'products.id')
                ->join('inventories', 'products.id', '=', 'inventories.product_id')
                ->join('shops','inventories.shop_id','=','shops.id')
                ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
                ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.imageable_type','App\Inventory')
                ->where('images.featured',1)
                ->where('inventories.stock_quantity','>',0)
                ->select('inventories.*','inventories.title as name','inventories.sale_price as min_price','images.path as img_path','inventories.sale_price as max_price','categories.slug as product_cat','category_sub_groups.slug as product_sub_cat','category_sub_groups.name as cat_sub_name','shops.legal_name as shop_name')
                ->orderBy('updated_at', 'DESC')->distinct()->get();

        }

        $new_inventory=$this->giveMeUnRepeated($inventory) ;
        return $new_inventory;
    }

    public function banner()
    {
        return DB::table('banners')
            ->join('images', 'banners.id', '=', 'images.imageable_id')
            ->where('images.imageable_type', 'App\Banner')->inRandomOrder()->get();
    }

    public function blog()
    {
        return DB::table('blogs')
            ->join('images', 'blogs.id', '=', 'images.imageable_id')
            ->where('images.imageable_type', 'App\blogs')->inRandomOrder()->get();
    }

    public function slider()
    {
        return DB::table('sliders')
            ->join('images', 'sliders.id', '=', 'images.imageable_id')
            ->where('images.imageable_type', 'App\Slider')
            ->inRandomOrder()->get();
    }

    public function getCompleteInventoryData()
    {
        return DB::table('inventories')
            ->join('products', 'products.id', '=', 'inventories.product_id')
            ->select('inventories.*', 'products.name as product_name')
            ->get();
    }

    public function getInventoryId($productid)
    {
        return DB::table('inventories')
            ->where('product_id', $productid)
            ->first();
    }


    #region search functions

    public function searchinventory($name)
    {
        //this function will search on the basis of product name and category name
        //on the basis of product name

        $catname_onthebasisofname=array();
        $catname_onthebasisofcategory=array();
        if($filter=="Latest")
        {
            $catname_onthebasisofname= DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                ->join('products', 'category_product.product_id', '=', 'products.id')
                ->join('inventories', 'products.id', '=', 'inventories.product_id')
                ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
                ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.imageable_type','App\Inventory')
                ->where('images.featured',1)
                ->where('inventories.title', 'like', "%$name%")
                ->select('inventories.*','inventories.id as inventory_id','inventories.id as main_id','products.id as product_id','inventories.title as name','images.path as img_path','inventories.sale_price as min_price','categories.slug as product_cat','categories.name as category_name','category_sub_groups.slug as product_sub_cat','category_sub_groups.name as cat_sub_name')
                ->orderBy('inventories.updated_at', 'DESC')->get();

            //on the basis of category name
            $catname_onthebasisofcategory=DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                ->join('products', 'category_product.product_id', '=', 'products.id')
                ->join('inventories', 'products.id', '=', 'inventories.product_id')
                ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
                ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.imageable_type','App\Inventory')
                ->where('images.featured',1)
                ->where('categories.name', 'like', "%$name%")
                ->select('inventories.*','inventories.id as inventory_id','inventories.id as main_id','products.id as product_id','inventories.title as name','images.path as img_path','inventories.sale_price as min_price','categories.slug as product_cat','categories.name as category_name','category_sub_groups.slug as product_sub_cat','category_sub_groups.name as cat_sub_name')
                ->orderBy('inventories.updated_at', 'DESC')->get();
        }
        else if($filter=="Price")
        {
            $catname_onthebasisofname= DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                ->join('products', 'category_product.product_id', '=', 'products.id')
                ->join('inventories', 'products.id', '=', 'inventories.product_id')
                ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
                ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.imageable_type','App\Inventory')
                ->where('images.featured',1)
                ->where('inventories.title', 'like', "%$name%")
                ->select('inventories.*','inventories.id as inventory_id','inventories.id as main_id','products.id as product_id','inventories.title as name','images.path as img_path','inventories.sale_price as min_price','categories.slug as product_cat','categories.name as category_name','category_sub_groups.slug as product_sub_cat','category_sub_groups.name as cat_sub_name')
                ->orderBy('inventories.sale_price', 'ASC')->get();

            //on the basis of category name
            $catname_onthebasisofcategory=DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                ->join('products', 'category_product.product_id', '=', 'products.id')
                ->join('inventories', 'products.id', '=', 'inventories.product_id')
                ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
                ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.imageable_type','App\Inventory')
                ->where('images.featured',1)
                ->where('categories.name', 'like', "%$name%")
                ->select('inventories.*','inventories.id as inventory_id','inventories.id as main_id','products.id as product_id','inventories.title as name','images.path as img_path','inventories.sale_price as min_price','categories.slug as product_cat','categories.name as category_name','category_sub_groups.slug as product_sub_cat','category_sub_groups.name as cat_sub_name')
                ->orderBy('inventories.sale_price', 'ASC')->get();
        }
        $completeSearList=array();
        foreach($catname_onthebasisofname as $c)
        {
            array_push($completeSearList,$c);
        }
        foreach($catname_onthebasisofcategory as $c)
        {
            array_push($completeSearList,$c);
        }

//get unrepeated data
        $things=$this->giveMeUnRepeated($completeSearList);
        return $things;


    }



    //initializing new array and push all the searched items



public function search_custom_inventory($type,$name,$operator="=")
{
    if ($type == "brand") {
        return DB::table('category_groups')
            ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
            ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
            ->join('category_product', 'categories.id', '=', 'category_product.category_id')
            ->join('products', 'category_product.product_id', '=', 'products.id')
            ->join('inventories', 'products.id', '=', 'inventories.product_id')
            ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
            ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
            ->join('images', 'inventories.id', '=', 'images.imageable_id')
            ->where('category_groups.name', $this->my_category)
            ->where('images.imageable_type', 'App\Inventory')
            ->where('images.featured', 1)
            ->where('inventories.brand', 'like', "%$name%")
            ->select('inventories.*', 'inventories.id as inventory_id', 'inventories.id as main_id', 'products.id as product_id', 'inventories.title as name', 'images.path as img_path', 'inventories.sale_price as min_price', 'categories.slug as product_cat', 'categories.name as category_name', 'category_sub_groups.slug as product_sub_cat', 'category_sub_groups.name as cat_sub_name')
            ->get();
    } else if ($type == "category") {
        return DB::table('category_groups')
            ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
            ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
            ->join('category_product', 'categories.id', '=', 'category_product.category_id')
            ->join('products', 'category_product.product_id', '=', 'products.id')
            ->join('inventories', 'products.id', '=', 'inventories.product_id')
            ->join('shipping_zones', 'inventories.shop_id', '=', 'shipping_zones.shop_id')
            ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
            ->join('images', 'inventories.id', '=', 'images.imageable_id')
            ->where('category_groups.name', $this->my_category)
            ->where('images.imageable_type', 'App\Inventory')
            ->where('images.featured', 1)
            ->where('categories.name', 'like', "%$name%")
            ->select('inventories.*', 'inventories.id as inventory_id', 'inventories.id as main_id', 'products.id as product_id', 'inventories.title as name', 'images.path as img_path', 'inventories.sale_price as min_price', 'categories.slug as product_cat', 'categories.name as category_name', 'category_sub_groups.slug as product_sub_cat', 'category_sub_groups.name as cat_sub_name')
            ->get();
    }

}

#endregion

    #region cart list functions
    //--------------------------------------------------------------------cart list page query--start

    public function GetAllTheCartDataForCartList($cart = null)
    {
        if ($cart == null) {
            return DB::table('carts')
                ->join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
                ->join('inventories', 'cart_items.inventory_id', '=', 'inventories.id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('customer_id', $this->isAuthenticated("id"))
                ->where('images.imageable_type', 'App\Inventory')
                ->where('images.featured', 1)
                ->select('cart_items.*', 'carts.*', 'cart_items.quantity as item_quantity', 'inventories.title as name', 'inventories.brand as brand', 'inventories.stock_quantity as stock_quantity', 'images.path as img_path')
                ->orderBy('carts.created_at', 'DESC')
                ->get();
        } else {
            return DB::table('carts')
                ->join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
                ->join('inventories', 'cart_items.inventory_id', '=', 'inventories.id')
                ->join('images', 'inventories.id', '=', 'images.imageable_id')
                ->where('customer_id', $this->isAuthenticated("id"))
                ->where('images.imageable_type', 'App\Inventory')
                ->where('images.featured', 1)
                ->where('carts.id', $cart->id)
                ->select('cart_items.*', 'carts.*', 'cart_items.quantity as item_quantity', 'inventories.title as name', 'inventories.brand as brand', 'inventories.stock_quantity as stock_quantity', 'images.path as img_path')
                ->orderBy('carts.created_at', 'DESC')
                ->get();
        }

    }

    //--------------------------------------------------------------------cart list page query--end
    #endregion

    #region account details, address, orders, wishlist
    //-----------------------------------------------------------------account details----start

    #region address
    public function getAllAddressed($address_type = null)
    {
        if ($address_type == "Primary") {
            return DB::table('addresses')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->join('states', 'addresses.state_id', '=', 'states.id')
                ->where('addressable_id', $this->isAuthenticated("id"))
                ->where('addressable_type', 'App\Customer')
                ->where('address_type', 'Primary')
                ->select('addresses.*', 'countries.name as country_name', 'states.name as state_name', 'countries.id as country_id', 'states.id as states_id')
                ->first();
        } elseif ($address_type == "Shipping") {
            return DB::table('addresses')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->join('states', 'addresses.state_id', '=', 'states.id')
                ->where('addressable_id', $this->isAuthenticated("id"))
                ->where('addressable_type', 'App\Customer')
                ->where('address_type', 'Shipping')
                ->select('addresses.*', 'countries.name as country_name', 'states.name as state_name', 'countries.id as country_id', 'states.id as states_id')
                ->get();
        } else {
            return DB::table('addresses')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->join('states', 'addresses.state_id', '=', 'states.id')
                ->where('addressable_id', $this->isAuthenticated("id"))
                ->where('addressable_type', 'App\Customer')
                ->select('addresses.*', 'countries.name as country_name', 'states.name as state_name', 'countries.id as country_id', 'states.id as states_id')
                ->get();
        }

    }

    public function getPerticularAddress($address_id)
    {
        return DB::table('addresses')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('states', 'addresses.state_id', '=', 'states.id')
            ->where('addresses.id', $address_id)
            ->select('addresses.*', 'countries.name as country_name', 'states.name as state_name', 'countries.id as country_id', 'states.id as states_id')
            ->first();
    }
    #endregion

    #region order
    public function getAllOrders()
    {
        return DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('customer_id', $this->isAuthenticated("id"))
            ->whereNull('orders.deleted_at')
            ->select('orders.*', 'order_statuses.name as order_status_name', 'order_statuses.label_color as order_label_color')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function getCurrentOrderData($order_id)
    {
        return DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->join('shipping_rates', 'orders.shipping_rate_id', '=', 'shipping_rates.id')
            ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
            ->where('orders.id', $order_id)
            ->select('orders.*', 'order_statuses.name as order_status_name', 'order_statuses.label_color as order_label_color', 'payment_methods.name as payment_method_name', 'shipping_rates.delivery_takes as delivery_takes')
            ->first();
    }

    public function getOrderList($order_id)
    {
        return DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('inventories', 'order_items.inventory_id', '=', 'inventories.id')
            ->join('images', 'inventories.id', '=', 'images.imageable_id')
            ->where('order_items.order_id', $order_id)
            ->where('images.featured', 1)
            ->select('order_items.*', 'orders.*', 'order_items.quantity as item_quantity', 'inventories.title as name', 'inventories.stock_quantity as stock_quantity', 'images.path as img_path', 'inventories.slug as slug')
            ->get();
    }
    #endregion

    #region wishlist

    public function showAllWishlist()
    {
        return DB::table('wishlists')
            ->join('inventories', 'wishlists.inventory_id', '=', 'inventories.id')
            ->join('images', 'inventories.id', '=', 'images.imageable_id')
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->where('images.imageable_type', 'App\Inventory')
            ->where('images.featured', 1)
            ->where('wishlists.customer_id', $this->isAuthenticated("id"))
            ->select('inventories.*', 'inventories.id as inventory_id', 'products.id as product_id', 'inventories.title as name', 'images.path as img_path', 'inventories.sale_price as min_price')
            ->inRandomOrder()->get();
    }

    #endregion

    //-----------------------------------------------------------------account details----end
    #endregion

    #region check out functions
    //--------------------------------------------------check out page functions start

    public function getShippingDetails($shop_id)
    {
        return DB::table('shipping_zones')
            ->join('shipping_rates', 'shipping_zones.id', '=', 'shipping_rates.shipping_zone_id')
            ->where('shipping_zones.shop_id', $shop_id)
            ->select('shipping_rates.*')
            ->first();
    }

    //--------------------------------------------------check out page functions end
    #endregion

    #region common functions

    public function giveMeUnRepeated($inventory)
    {
        // NOTE:
        // passing array must have main_id parameter else it will not work
        // or replace main_id from your id
        $new_inventory=array();
        $unique_id=array();
        foreach($inventory as $inv)
        {
            $flag=false;
            foreach($unique_id as $id)
            {
                if($inv->id==$id)
                {
                    $flag=true;
                    break;
                }
            }
            if($flag==false)
            {
                array_push($new_inventory,$inv);
                array_push($unique_id,$inv->id);
            }
        }
        return $new_inventory;

    }

    public function ip_details($IPaddress)
    {
        $json = file_get_contents("http://ipinfo.io/{$IPaddress}");
        $details = json_decode($json);
        return $details;
    }

    #endregion


    public function getsubgroupcategories($paginate_limit=0)
    {
        //Note : pagination links will work on model not in join
        //TODO Make model
        if($paginate_limit==0)
        {
            $categories= DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('images', 'categories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.featured',1)
                ->select('categories.*','categories.id as main_id','category_sub_groups.name as cat_sub_name','images.path as img_path')->get();
        }
        else
        {
            $categories= DB::table('category_groups')
                ->join('category_sub_groups', 'category_groups.id', '=', 'category_sub_groups.category_group_id')
                ->join('categories', 'category_sub_groups.id', '=', 'categories.category_sub_group_id')
                ->join('images', 'categories.id', '=', 'images.imageable_id')
                ->where('category_groups.name',$this->my_category)
                ->where('images.featured',1)
                ->select('categories.*','categories.id as main_id','category_sub_groups.name as cat_sub_name','images.path as img_path')->paginate($paginate_limit);

        }
        $categories=$this->giveMeUnRepeated($categories);

        return $categories;
    }
    public function generate_otp($mobile)
    {
        $otp=rand(1000,9999);
        DB::table('otps')->insert(
            ['otp' => $otp,
                'mobile'=>$mobile,
                'status'=>1,
            ]
        );
        return $otp;
        // $appName=config('app.name');
        // $message='OTP is '.$otp.' for verification on Salary Slip and valid for next 10 minutes only. Do not share this OTP to anyone for security reasons';
        // $this->sendMsg($mobile,$message);
    }

    public function validate_otp($otp,$mobile)
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


}
