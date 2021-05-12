<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Shop\ShopRepository;
use DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $url;

    use ProcessResponseTrait,ValidationTrait;

    public function __construct(ShopRepository $shop, OrderRepository $orders)
    {
        $this->orders = $orders;
        $this->shop = $shop;
    }
    public function home(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            
            if($users->shop_id != null)
            {
                $total_sale = 0;
                $order_data = array();
                $request->shop_id = $users->shop_id;
                $request->limit = 5;
                $shop_category = DB::table('shop_categories')->where('shop_id',$users->shop_id)->first();
                $shop_kyc = DB::table('bank_details')->where('bankable_id',$users->shop_id)->first();
                $shop_product = DB::table('products')->where('shop_id',$users->shop_id)->first();
               
                $all_orders = $this->orders->shopOrder($request);
                $shop = $this->shop->all($users->shop_id);

                $product_visit_count = DB::table('product_visit_count')->where('shop_id',$users->shop_id)->sum('hits');
                foreach($shop->orders as $order)
                {
                    $total_sale = $total_sale+$order->grand_total;
                }

                // foreach($all_orders as $order)
                // {
                //     $order_data[] = array(
                //         'id' => $order->id,
                //         'order_number' => $order->order_number,
                //         'order_id' => $order->order_id,
                //         'order_item_count' => count($order->inventories),
                //         'order_item_image' => count($order->inventories[0]->images) > 0 ? $order->inventories[0]->images[0]->path : 'no image found',
                //         'order_date' => date('d M, Y',strtotime($order->created_at)),
                //         'grand_total' => $order->grand_total,
                //         'order_status' => $order->status->name,
                //     );
                // }
                $data = array(
                    'shop_id' => $shop->id,
                    'shop_name' => $shop->legal_name,
                    'address' => $shop->addresses ? true : false,
                    'shop_slug' => $shop->slug,
                    'email' => $shop->email,
                    'shop_image' => $shop->image ? $shop->image->path : null,
                    'shop_banner' => $shop->image ? $shop->image->bannerpath : null,
                    'phone' => $shop->owner->phone,
                    'products_count' => $shop->products ? count($shop->products) : 0,
                    'product_visit_count' =>$product_visit_count,
                    'inventories_count' => $shop->inventories ? count($shop->inventories) : 0,
                    'store_visit_count' => $shop->store_visit_count,
                    'store_last_visit' => date('d M Y H:i:s',strtotime($shop->updated_at)),
                    'order_count' => $shop->orders ? count($shop->orders) : 0,
                    'total_sale' => $total_sale,
                    'orders' => $order_data,
                    'seller_category' => $shop_category ? true : false,
                    'seller_kyc' => $shop_kyc ? true : false,
                    'seller_product' => $shop_product ? true : false,
                    
                );
            }
            
            return $this->processResponse('shop_data',$data,'success','Shop Details');
        }   
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
}
