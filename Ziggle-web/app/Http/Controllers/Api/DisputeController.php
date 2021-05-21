<?php

namespace App\Http\Controllers\Api;
use DB;
use Auth;
use App\Customer;
use App\Order;
use App\DisputeType;
use App\System;
use App\Dispute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Dispute\DisputeCreated;
use App\Events\Dispute\DisputeUpdated;
use App\Events\Dispute\DisputeSolved;
use App\Http\Resources\OrderResource;
use App\Http\Resources\DisputeResource;
use App\Http\Resources\DisputeFormResource;
use App\Http\Resources\DisputeLightResource;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Http\Requests\Validations\DisputeDetailRequest;
use App\Http\Requests\Validations\CreateDisputeRequest;
use App\Http\Requests\Validations\ReplyDisputeRequest;
use App\Notifications\SuperAdmin\DisputeAppealed as DisputeAppealedNotification;

class DisputeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      { 
        $customer = Customer::find($cust_id->user_id);
     
        $disputes = $customer->disputes()
        ->with(['shop:id,name,slug', 'order.inventories:product_id,slug', 'order.inventories.image'])
        ->paginate(config('mobile_app.view_listing_per_page', 8));

        $dispute = DisputeLightResource::collection($disputes);
        
        return $this->processResponse('data',$dispute,'success','Dispute list show successfully!!');
    } 
      else
          return $this->processResponse(null,null,'error','Enter correct login details'); 
    }

    /**
     * show_dispute_form
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OrderDetailRequest $request, Order $order)
    {
        return new DisputeFormResource($order);
    }

    /**
     * open_dispute
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      { 
        $dispute = new Dispute;
        $dispute->order_id = $order->id;
        $dispute->shop_id = $order->shop_id;
        $dispute->customer_id = $order->customer_id;
        $dispute->dispute_type_id = $request->dispute_type_id;
        $dispute->order_received = $request->order_received;
        $dispute->description = $request->description;
        $dispute->product_id = $request->product_id;
        $dispute->refund_amount = $order->grand_total;
        $dispute->status = Dispute::STATUS_NEW;
        $dispute->save();
        
       // event(new DisputeCreated($dispute));
       //Order status update
        Order::where('id',$order->id)->update(['order_status_id'=>Order::STATUS_RETURNED]);

        $dispute = new DisputeResource($dispute);
         return $this->processResponse('data',$dispute,'success','Order return request created successfully!!');
    } 
      else
          return $this->processResponse(null,null,'error','Enter correct login details');   
    }

    /**
     * show dispute detail
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Dispute   $dispute
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dispute $dispute)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      { 
        $dispute = new DisputeResource($dispute->load('shop:id,name,slug'));
        return $this->processResponse('data',$dispute,'success','Dispute details show successfully!!');
    } 
      else
          return $this->processResponse(null,null,'error','Enter correct login details');  
    }

    /**
     * show response_form
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Dispute  $dispute
     *
     * @return \Illuminate\Http\Response
     */
    public function response_form(DisputeDetailRequest $request, Dispute $dispute)
    {
        return [
            'dispute' => $dispute,
            'statuses' => \App\Helpers\ListHelper::dispute_statuses()
        ];
    }

    /**
     * [response description]
     *
     * @param  ReplyDisputeRequest $request [description]
     * @param  Dispute             $dispute [description]
     *
     * @return [type]                       [description]
     */
    public function response(ReplyDisputeRequest $request, Dispute $dispute)
    {
        // Update status
        if($dispute->status != $request->status){
            $dispute->status = $request->status;
            $dispute->save();
        }

        $response = $dispute->replies()->create($request->all());

        if ($request->hasFile('attachments'))
            $response->saveAttachments($request->file('attachments'));

        event(new DisputeUpdated($response));

        return new DisputeResource($dispute->load('shop:id,name,slug'));
    }

    public function mark_as_solved(DisputeDetailRequest $request, Dispute $dispute)
    {
        $dispute->status = Dispute::STATUS_SOLVED;

        $dispute->save();

        event(new DisputeSolved($dispute));

        return response()->json(trans('theme.notify.dispute_updated'), 200);
    }

    /**
     * [appeal description]
     *
     * @param  ReplyDisputeRequest $request [description]
     * @param  Dispute             $dispute [description]
     *
     * @return [type]                       [description]
     */
    public function appeal(ReplyDisputeRequest $request, Dispute $dispute)
    {
        $dispute->status = Dispute::STATUS_APPEALED;
        $dispute->save();

        $response = $dispute->replies()->create($request->all());

        if ($request->hasFile('attachments'))
            $response->saveAttachments($request->file('attachments'));

        // Send notification to Admin
        if( config('system_settings.notify_when_dispute_appealed')){
            $system = System::orderBy('id', 'asc')->first();
            $system->superAdmin()->notify(new DisputeAppealedNotification($response));
        }

        event(new DisputeUpdated($response));

        return new DisputeResource($dispute->load('shop:id,name,slug'));
    }

    public function dispute_types(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      { 
        $dispute_types = DisputeType::all();
        return $this->processResponse('data',$dispute_types,'success','Dispute types show successfully!!');
     } 
      else
          return $this->processResponse(null,null,'error','Enter correct login details'); 
    }
}
