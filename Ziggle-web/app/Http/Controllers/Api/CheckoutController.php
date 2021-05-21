<?php

namespace App\Http\Controllers\Api;

use DB;
// use Auth;
// use App\Shop;
use App\Cart;
use App\Order;
use App\Bonus;
use Carbon;
use App\Referral;
use App\Transaction;
use App\Wallet;
use App\Customer;
// use App\Order;
// use App\Coupon;
// use App\Inventory;
// use App\Packaging;
// use App\ShippingRate;
// use App\Helpers\ListHelper;
// use Illuminate\Http\Request;
use App\Events\Order\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Validations\DirectCheckoutRequest;
use App\Http\Requests\Validations\ApiCheckoutCartRequest;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class CheckoutController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    /**
     * Checkout the specified cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(ApiCheckoutCartRequest $request, Cart $cart)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
      {  
        // if(! crosscheckCartOwnership($request, $cart)) {
        //     return response()->json(['message' => trans('theme.notify.please_login_to_checkout')], 404);
        // }

        // Update the cart
        $cart->shipping_rate_id = $request->shipping_option_id;
        $cart->packaging_id = $request->packaging_id;
        $cart->payment_method_id = $request->payment_method_id;
        $cart->shipping_address = $request->shipping_address;
        $cart->shipping = $request->shipping_option_id ? getShippingingCost($request->shipping_option_id) : Null;

        if($request->packaging_id) {
            $cart->packaging = getPackagingCost($request->packaging_id);
        }

        $cart->grand_total = $cart->grand_total();
        $cart->save();

        $cart = crosscheckAndUpdateOldCartInfo($request, $cart);

        // Start transaction!
        DB::beginTransaction();
        try {
            // Create the order from the cart
            $order = saveOrderFromCart($request, $cart);

        } catch(\Exception $e){
            \Log::error($e);        // Log the error

            // rollback the transaction and log the error
            DB::rollback();

            return response()->json(trans('theme.notify.order_creation_failed'), 500);
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        $cart->forceDelete();   // Delete the cart

        // event(new OrderCreated($order));  

          //Add outstanding bonus at the time order placed in customer bonus tracker
          $mytime = Carbon\Carbon::now(); 
          $today = $mytime->toDateTimeString();
          $current_year = date("20y", strtotime($today));
          $current_month = date("m", strtotime($today));
          $current_date = date("d", strtotime($today)); 
          $current_format_date = $current_year.'-'.$current_month.'-'.$current_date;
          $date = Carbon\Carbon::create($current_year, $current_month, $current_date); 
          $start_day_of_week = $date->startOfWeek();
          $start_day = $start_day_of_week->toDateTimeString();
          $end_day_of_week = $date->endOfWeek();
          $end_day = $end_day_of_week->toDateTimeString();

          $bonus_amount = DB::table('orders')
          ->where('customer_id',$cust_id->user_id)
          ->whereBetween('created_at', [$start_day, $end_day])
          ->sum('total');

         $level = 0;
         $level_bonus = 0;
         $final_amount = ($order->total) + $bonus_amount; 
         
         if($final_amount < 5000)
         {
          $level = 6;
          $level_bonus = (6/100) * $order->total;
         }
         else if($final_amount >= 5000 && $final_amount<=10000)
         {
            $level = 6;
            $level_bonus = (6/100) * $order->total;
         }
         else if($final_amount >= 10000 && $final_amount <=20000)
         {
           $level = 8;
           $level_bonus = (8/100) * $order->total;
         }
         else if($final_amount >=20000 && $final_amount <=50000 )
         {
           $level = 10;
           $level_bonus = (10/100) * $order->total;
         }
         else if($final_amount >= 50000)
         {
           $level = 12;
           $level_bonus = (12/100) * $order->total; 
         }
         
          $bonus = new Bonus;
          $bonus->customer_id = $order->customer_id;
          $bonus->order_id = $order->id;
          $bonus->order_status = 'Pending';
          $bonus->start_date = $start_day;
          $bonus->today_date = $today;
          $bonus->end_date = $end_day;
          $bonus->bonus_type = 'Outstanding Bonus';
          $bonus->bonus_outstanding = $level_bonus;
          $bonus->bonus_paid  = 0;
          $bonus->left_amount = 0;
          $bonus->save();
          

        $checkout = new OrderResource($order);
          return $this->processResponse('Checkout',$checkout,'success','Order placed successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Direct checkout with the item/cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str $slug
     *
     * @return \Illuminate\Http\Response
     */
    // public function directCheckout(DirectCheckoutRequest $request, $slug)
    // {
    //     $cart = $this->addToCart($request, $slug);

    //     if (200 == $cart->status())
    //         return redirect()->route('cart.index', $cart->getdata()->id);
    //     else if (444 == $cart->status())
    //         return redirect()->route('cart.index', $cart->getdata()->cart_id);

    //     return redirect()->back()->with('warning', trans('theme.notify.failed'));
    // }
   
}