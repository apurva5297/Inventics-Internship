<?php

namespace App\Http\Controllers\Api;
use DB;
use Auth;
use App\Product;
use App\Wishlist;
use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductWishlistResource;
use App\Http\Resources\WishlistResource;
use App\Http\Requests\Validations\DirectCheckoutRequest;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class WishlistController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        { 
        $start = ($request->page - 1) * 10;
        $product_ids = array();
        $product_id = Wishlist::select('product_id')->where('customer_id',$cust_id->user_id)->get();
       foreach($product_id as $key)
       {
           $product_ids[] = $key->product_id;
       }
        $products = Product::whereIn('id',$product_ids)->with(['inventories.image:path,imageable_id'])->withCount(['inventories' => function($query){
            $query->available();
        }])->having('inventories_count', '>', 2)->offset($start)->take(5)->get();

        $wishlist =ProductWishlistResource::collection($products);
        return $this->processResponse('data',$wishlist,'success','Wishlist show successfully!!');
    } 
    else
        return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Add item to the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $slug)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        { 
        $item = Product::where('slug', $slug)->firstOrFail();
      
        $customer_id = $cust_id->user_id;

        $item_in_wishlist = Wishlist::where('product_id', $item->id)
        ->where('customer_id', $customer_id)->first();

        if($item_in_wishlist) {
            return response()->json(['data'=>$item_in_wishlist,'status'=>'success','message' => trans('api.item_alrealy_in_wishlist')], 200); // Item alrealy in cart
        }

        $wishlist = new Wishlist;
        $wishlist->inventory_id = 0;
        $wishlist->product_id = $item->id;
        $wishlist->customer_id = $customer_id;
        $wishlist->save();

        return response()->json(['data'=>$wishlist,'status'=>'success','message' => trans('api.item_added_to_wishlist')], 200);
      //  return $this->processResponse(null,null,'success','Address store successfully!!');
    } 
    else
        return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, Wishlist $wishlist)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        { 
       // $this->authorize('remove', $wishlist);

        $wishlist->forceDelete();

        return response()->json(['data'=>null,'status'=>'success','message' => trans('api.item_removed_from_wishlist')], 200);
          //  return $this->processResponse(null,null,'success','Address store successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }
}