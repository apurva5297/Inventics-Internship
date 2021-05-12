<?php

namespace App\Http\Middleware;
use App\Product;
use App\Inventory;
use App\User;
use App\Shop;
use Auth;
use Closure;

class ShopSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $shop_id = Auth::user()->shop->id;
        //dd($shop_id);
        if(!empty($shop_id))
        {
            $shops = Shop::where('id',$shop_id)->first();
             
            $products = Product::where('shop_id',$shop_id)->get();
            $inventories = Inventory::where('shop_id',$shop_id)->get();
            if(count($products) < 1)
            {
                return redirect()->route('admin.catalog.product.create')->with('message', 'Create your product first');
            }
            if(count($inventories) < 1)
            {
                return redirect('admin/stock/inventory')->with('message', 'Create your first inventory');
            }

            // if($shops->image)
            // {
            //     return redirect('admin/stock/inventory')->with('message', 'Upload your shop banner and logo image');
            // }

            // if(!$shops->primaryAddress)
            // {
            //     return redirect('admin/stock/inventory')->with('message', 'Update your shop address');
            // }
        }
        return $next($request);
    }
}
