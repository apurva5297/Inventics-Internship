<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\Order;
use App\Address;
use App\Inventory;
use App\OrderItems;
use DB;
use Illuminate\Support\Facades\Auth;


class Ordercontroller extends Controller
{
    public function place_order(Request $request)
    {
        $orderAddress=Address::where('id',$request->shipping_address)->first();
        $orderCart=cart::where('id',$request->cart_id)->first();
        //dd($orderAddress);
        //-----------create Order in Orders Table-------------
        $order=new Order;
        // dd($order);
        $order->order_number='#'.$request->customer_id.$request->cart_id;
        $order->shop_id=$request->shop_id;
        $order->customer_id=$request->customer_id;
        $order->ship_to=$orderAddress->country_id;
        $order->shipping_zone_id=$request->shipping_zone_id;
        $order->item_count=$orderCart->item_count;
        $order->quantity=$orderCart->quantity;
        $order->total=$orderCart->total;
        $order->grand_total=$orderCart->total;
        if(isset($request->checkbox2))
        {
            $order->billing_address= $orderAddress->address_title.', '.$orderAddress->address_line_1.','.$orderAddress->address_line_2.','.$orderAddress->city.', ('.$orderAddress->zip_code.')';
        }
        $order->shipping_address=$orderAddress->address_title.' '.$orderAddress->address_line_1.','.$orderAddress->address_line_2.','.$orderAddress->city.', ('.$orderAddress->zip_code.')';
//dd($request->radio2);
        $order->payment_method_id=$request->radio2;

        $order->save();
        //----------- /create Order in Orders Table-------------

        //----------------Update Order_Items Table -------------
        //get data from cart_items
        $order_items=DB::table('cart_items')->where('cart_id',$request->cart_id)->get();


        foreach($order_items as $order_item)
        {
            $order_item_pivot_data = [];
            $order_item_pivot_data[$order_item->inventory_id] = [
                'inventory_id' => $order_item->inventory_id,
                'item_description'=> $order_item->item_description,
                'quantity' =>$order_item->quantity,
                'unit_price' => $order_item->unit_price,
            ];

            // Save order items into pivot
            if ( ! empty($order_item_pivot_data) )
            {
                $order->inventories()->syncWithoutDetaching($order_item_pivot_data);
            }
        }

        //---------------delete cart after item------------
        $orderCart->delete();
        session()->flash('success','Order placed successfully');
        return redirect()->route('order-history');
    }
    public function cancel_order( Request $request)
    {
        $cancelOrder=Order::where('id',$request->order_id)->first();
        //dd($cancelOrder);
        $cancelOrder->order_status_id= 8;
        $cancelOrder->save();
        session()->flash('warning','Order Cancel by Customer');
        return "order canceled";
    }
    public function Reorder($order_uid)
    {

        $response="";
        $cart_id=0;

        //from the order id in order table fetch all the data
        $oldorder=Order::where('id',$order_uid)->first();

        $oldorder_items=OrderItems::where('order_id',$oldorder->id)->get();
        $cat_product=Inventory::all();

        //aim is if we have sufficient stock quantity left in the inventory then only update else give error msg
        $shouldIUpdate=true;
        $temp_product_name="";
        foreach($oldorder_items as $item)
        {
            $have_stock=false;
            foreach($cat_product as $inventory)
            {
                if($item->inventory_id==$inventory->id)
                {
                    if($inventory->stock_quantity >= $item->quantity)
                    {
                        $have_stock=true;
                    }
                    else
                    {
                        $temp_product_name=$inventory->title;//if i dont have quantity then store the name of that product
                    }
                }
            }

            if(!$have_stock)
            {
                $shouldIUpdate=false;
            }
        }

        if($shouldIUpdate)
        {
            //check cart

            $cart = $this->moveAllItemsToCartAgain($oldorder);
            $cart_id=$cart->id;
            $response="success";
            return redirect()->route('checkout1',$cart_id);
        }
        else
        {
            $response="dont have stock of product ".$temp_product_name;
            //give flash msg $response
            return redirect()->back();
        }



    }

    #endregion


    public function clear_orderhistory( Request $request)
    {
        $customer_id=Auth::id();

        $orders=Order::where('customer_id',$customer_id)->get();
        //store cancel order id
        $order_id_for_cancel=array();
        foreach($orders as $order)
        {
            if($order->order_status_id==6||$order->order_status_id==8)//6 means delivered and 8 mean buyercancel
                array_push($order_id_for_cancel,$order->id);
        }
        //dd($cancelOrder);
        //update order deleted at coloumn(dont forget to add soft delete in order model otherwise it will delete data permanentely)
        Order::whereIn('id',$order_id_for_cancel)->delete();
        return redirect()->back();
    }
    function moveAllItemsToCartAgain($order, $revert = false)
    {
        if( !$order instanceOf Order ) {
            $order = Order::find($order);
        }

        if (! $order) return;

        // echo "<pre>"; print_r($order->items->toArray()); echo "<pre>"; exit('end!');

        // Save the cart
        $cart = cart::create([
            'shop_id' => $order->shop_id,
            'customer_id' => $order->customer_id,
            'ship_to' => $order->ship_to,
            'shipping_zone_id' => $order->shipping_zone_id,
            'shipping_rate_id' => $order->shipping_rate_id,
            'packaging_id' => $order->packaging_id,
            'item_count' => $order->item_count,
            'quantity' => $order->quantity,
            'taxrate' => $order->taxrate,
            'shipping_weight' => $order->shipping_weight,
            'total' => $order->total,
            'shipping' => $order->shipping,
            'packaging' => $order->packaging,
            'handling' => $order->handling,
            'taxes' => $order->taxes,
            'grand_total' => $order->grand_total,
            'ip_address' => request()->ip(),
        ]);

        // Add order item into cart pivot table
        $cart_items = [];
        foreach ($order->inventories as $item) {
            $cart_items[] = [
                'cart_id'           => $cart->id,
                'inventory_id'      => $item->pivot->inventory_id,
                'item_description'  => $item->pivot->item_description,
                'quantity'          => $item->pivot->quantity,
                'unit_price'        => $item->pivot->unit_price,
                'created_at'        => $item->pivot->created_at,
                'updated_at'        => $item->pivot->updated_at,
            ];

            // Sync up the inventory. Increase the stock of the order items from the listing
            if($revert) {
                $item->increment('stock_quantity', $item->pivot->quantity);
            }
        }

        \DB::table('cart_items')->insert($cart_items);

        // if($revert){
        //     // Increment the coupone in use
        //     if ($order->coupon_id) {
        //         Coupon::find($order->coupon_id)->increment('quantity');
        //     }

        //     $order->forceDelete();   // Delete the order
        // }

        return $cart;
    }

#endregion




}
