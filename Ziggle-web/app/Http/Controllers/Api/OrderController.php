<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use App\Order;
use App\Reply;
use App\Feedback;
use App\Customer;
use App\Cancellation;
use App\CancellationReason;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderLightResource;
use App\Http\Resources\ConversationResource;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Http\Requests\Validations\DirectCheckoutRequest;
// use App\Http\Requests\Validations\DirectCheckoutRequest;
use App\Http\Requests\Validations\ConfirmGoodsReceivedRequest;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class OrderController extends Controller
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
        $customer = Customer::find($cust_id->user_id);
        switch($request->type)
        {
            case 1:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            case 3:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            case 4:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            case 5:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'    
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            case 6:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            case 7:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            case 8:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])->where('order_status_id',$request->type)
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
            default:
                $orders = $customer->orders()
                ->with([
                    'shop:id,name,slug',
                    'inventories:id,title,slug,product_id',
                    'inventories.image:path,imageable_id,imageable_type',
                    'dispute:id,order_id'
                ])
                ->get();
                $orders = OrderLightResource::collection($orders);
            break;
        }
       
        return $this->processResponse('Order_list',$orders,'success','Order show successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display order detail page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        $order->load([
            'conversation:id,order_id,user_id,customer_id,subject,message,product_id,status,updated_at',
            'conversation.attachments',
            'feedback'
        ]);

        return new OrderResource($order);
    }


    /**
     * Display order conversation page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function conversation(OrderDetailRequest $request, Order $order)
    {
        $order->load(['shop:id,name,slug','conversation.replies','conversation.replies.attachments']);

        return new ConversationResource($order->conversation);
    }

    /**
     * Start/Replay a order conversation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function save_conversation(OrderDetailRequest $request, Order $order)
    {
        $user_id = Auth::user()->id;

        if($order->conversation){
            $msg = new Reply;
            $msg->reply = $request->input('message');

            if(Auth::guard('api')->check()) {
                $msg->customer_id = $user_id;
            }
            else {
                $msg->user_id = $user_id;
            }

            $order->conversation->replies()->save($msg);
        }
        else {
            $msg = new Message;
            $msg->message = $request->input('message');
            $msg->shop_id = $order->shop_id;

            if(Auth::guard('api')->check()){
                $msg->subject = trans('theme.defaults.new_message_from', ['sender' => Auth::user()->getName()]);
                $msg->customer_id = $user_id;
            }
            else{
                $msg->user_id = $user_id;
            }

            $order->conversation()->save($msg);
        }

        // Update the order if goods_received
        if($request->has('goods_received')) {
            $order->goods_received();
        }

        if ($request->hasFile('photo')) {
            $msg->saveAttachments($request->file('photo'));
        }

        return new ConversationResource($order->conversation);
    }

    /**
     * Buyer confirmed goods received
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function goods_received(ConfirmGoodsReceivedRequest $request, Order $order)
    {
        $order->mark_as_goods_received();

        return new OrderResource($order);
    }

    /**
     * Track order shippping.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function track(Request $request, Order $order)
    {
        $url = $order->getTrackingUrl();

        // if ( ! $url )
        //     $url = ;

        return response()->json(['tracking_url' => $url], 200);
    }
    
    public function cancel_order(Request $request,Order $order)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
        $customer_id = $cust_id->user_id;
        $cancellation = new Cancellation;
        $cancellation->shop_id = $request->shop_id;
        $cancellation->customer_id = $customer_id;
        $cancellation->order_id = $order->id;
        $cancellation->description = $request->description;
        $cancellation->items = $order->items;
        $cancellation->status = Cancellation::STATUS_DECLINED;
        $cancellation->save();
          // Check if has a cancellation request
          if ($order->cancellation) {
            $order->cancellation->forceFill([
                'items' => Null,
                'status' => Cancellation::STATUS_DECLINED,
            ])->save();
        }

        $order->cancel();

        DB::table('activity_log')->insert([
            'log_name' => 'order',
            'description' => 'updated',
            'subject_id' => $order->id,
            'subject_type' => 'App\Order',
            'causer_id' => $cust_id->user_id,
            'causer_type' => 'App\User',
            'properties' => '{"attributes":{"order_status_id":'.$order->order_status_id.'},"old":{"order_status_id":8}}',
            'created_at' =>  \Carbon\Carbon::now(), 
            'updated_at' => \Carbon\Carbon::now(), 
        ]);

        return $this->processResponse(null,null,'success','Order cancelled successfully!!');
    } 
    else
        return $this->processResponse(null,null,'error','Enter correct login details');

    }

    public function get_reason_list(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
            $cancellation_reasons = CancellationReason::all();
            return $this->processResponse('data',$cancellation_reasons,'success','Order cancelled successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');  
    }

    public function get_reviews(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
            $feedback = new Feedback;
            $feedback->customer_id = $cust_id->user_id;
            $feedback->rating = $request->rating;
            $feedback->comment = $request->comment;
            $feedback->feedbackable_id = $request->feedback_id;
            $feedback->feedbackable_type = $request->feedback_type;
            $feedback->approved = 1;
            $feedback->spam = 0;
            $feedback->save();

            return $this->processResponse('data',$feedback,'success','Feedback saved successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');  
    }

    public function order_return(Request $request,$order)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
            $order = Order::where('id',$order)->update(['order_status'=>Order::STATUS_RETURNED]);
            return $this->processResponse('data',$order,'success','Order pending request generated successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');    
    }
}