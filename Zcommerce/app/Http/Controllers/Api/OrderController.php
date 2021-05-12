<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Repositories\Order\OrderRepository;
use App\Repositories\OrderStatus\OrderStatusRepository;
use App\ReturnOrders;
use App\Order;
use App\BankDetail;

class OrderController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function __construct(OrderStatusRepository $order_status, OrderRepository $orders)
    {
        $this->orders = $orders;
        $this->order_status = $order_status;
    }

    public function orders(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$data = array();
        	if($users->shop_id != null)
            {
                $order_data = array();
                $request->shop_id = $users->shop_id;
                $all_orders = $this->orders->shopOrder($request);
                $check_kyc = BankDetail::where(['bankable_type' =>'App\Shop','bankable_id' => $users->shop_id])->first();
                foreach($all_orders as $order)
                {
                    $data[] = array(
                        'id' => $order->id,
                        'order_number' => $order->order_number,
                        'order_id' => $order->order_id,
                        'order_item_count' => count($order->inventories),
                        'order_item_image' => $order->inventories[0]->product->image ? $order->inventories[0]->product->image->path : 'no image found',
                        'order_date' => date('d M, Y',strtotime($order->created_at)),
                        'grand_total' => $order->grand_total,
                        'order_status' => $order->status->name,
                        'customer_name' => $order->customer->name,
                        'customer_email' => $order->customer->email,
                        'customer_phone' => $order->customer->phone,
                        'shipping_address' => $order->shipping_address,
                        'customer_address' => $order->customer->addresses[0],
                        'invoice_pdf' => $order->invoice_file,
                        'kyc' => $check_kyc ? true : false,
                    );
                }
            }
            return $this->processResponse('order_data',$data,'success','Order List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function orderDetail(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            if($users->shop_id != null)
            {
                $request->shop_id = $users->shop_id;
                $order_details = $this->orders->shopOrderDetail($request);
                $items = array();
                foreach($order_details->inventories as $item)
                {
                    $items[] = array(
                        'images' => $item->image ? $item->image->path : 'No image found',
                        'item_desc' => $item->pivot->item_description,
                        'unit_price' => get_formated_currency($item->pivot->unit_price),
                        'qty' => $item->pivot->quantity,
                        'total' => get_formated_currency($item->pivot->quantity * $item->pivot->unit_price),
                    );
                }
                $data = array(
                    'id' => $order_details->id,
                    'order_id' => $order_details->order_id,
                    'order_number' => $order_details->order_number,
                    'grand_total' => $order_details->grand_total,
                    'billing_address' => $order_details->billing_address,
                    'shipping_address' => $order_details->shipping_address,
                    'delivery_date' => date('d m,Y',strtotime($order_details->delivery_date)),
                    'order_date' => date('d m,Y',strtotime($order_details->created_at)),
                    'tracking_id' => $order_details->tracking_id,
                    'customer_name' => $order_details->customer->name,
                    'customer_email' => $order_details->customer->email,
                    'customer_phone' => $order_details->customer->phone,
                    'payment_method' => $order_details->paymentMethod->name,
                    'order_status' => $order_details->status->name,
                    'order_items' => $items,
                    'customer_address' => $order_details->customer->addresses[0],
                    'invoice_pdf' => $order_details->invoice_file,
                );
            }
            return $this->processResponse('order_detail',$data,'success','Order Details');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function orderStatusList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $order_status_lists = $this->orders->orderStatusList();
            $data = array();
            foreach($order_status_lists as $status)
            {
                $data[] = array(
                    'id' => $status->id,
                    'name' => $status->name,
                    'label_color' => $status->label_color,
                );
            }
            return $this->processResponse('order_status_list',$data,'success','Order Status List');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function orderStatusUpdate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $request->shop_id = $users->shop_id;
            $message = $this->orders->orderStatusUpdate($request);
            return $this->processResponse('order_status_update',null,'success',$message);
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function returns(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            $returns = ReturnOrders::with('shop','customer')->where('shop_id',$users->shop_id)->get();
            foreach($returns as $return)
            {
                $order = Order::where('id',$return->return_order_id)->first();
                $data[] = array(
                    'id' => $return->id,
                    'order_number' => $order->order_number,
                    'order_id' => $order->id,
                    'item_count' => count($order->inventories),
                    'item_image' => $order->inventories[0]->image ? $order->inventories[0]->image->path : 'No Image Found',
                    'date' => date('d M, Y',strtotime($return->created_at)),
                    'grand_total' => $order->grand_total,
                    'return_status' => $return->ReturnStatus['name'],
                    'customer_name' => $order->customer->name,
                    'customer_email' => $order->customer->email,
                    'customer_phone' => $order->customer->phone,
                    'shipping_address' => $order->shipping_address,
                    'customer_address' => $order->customer->addresses[0]
                );
            }
            return $this->processResponse('return_data',$data,'success','Return List');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function returnDetail(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            if($users->shop_id != null)
            {
                $request->shop_id = $users->shop_id;
                $return_id = $request->return_id;
                $return = ReturnOrders::where('id',$return_id)->first();
                $order_details = Order::where(['id'=>$return->return_order_id])->first();
                $items = array();
                foreach($order_details->inventories as $item)
                {
                    $items[] = array(
                        'images' => $item->image ? $item->image->path : "no image found",
                        'item_desc' => $item->pivot->item_description,
                        'unit_price' => get_formated_currency($item->pivot->unit_price),
                        'qty' => $item->pivot->quantity,
                        'total' => get_formated_currency($item->pivot->quantity * $item->pivot->unit_price),
                    );
                }
                $data = array(
                    'id' => $return->id,
                    'order_id' => $order_details->id,
                    'order_number' => $order_details->order_number,
                    'grand_total' => $order_details->grand_total,
                    'billing_address' => $order_details->billing_address,
                    'shipping_address' => $order_details->shipping_address,
                    'return_date' => date('d m,Y',strtotime($return->created_at)),
                    'tracking_id' => $order_details->tracking_id,
                    'customer_name' => $order_details->customer->name,
                    'customer_email' => $order_details->customer->email,
                    'customer_phone' => $order_details->customer->phone,
                    'payment_method' => $order_details->paymentMethod->name,
                    'return_status' => $return->ReturnStatus['name'],
                    'return_items' => $items,
                    'customer_address' => $order_details->customer->addresses[0]
                );
            }
            return $this->processResponse('return_detail',$data,'success','Return Details');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function returnStatusList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $return_status_lists = \DB::table('return_statuses')->get();
            $data = array();
            foreach($return_status_lists as $status)
            {
                $data[] = array(
                    'id' => $status->id,
                    'name' => $status->name,
                    'label_color' => $status->label_color,
                );
            }
            return $this->processResponse('return_status_list',$data,'success','Return Status List');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function returnStatusUpdate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $message = ReturnOrders::where('id',$request->return_id)->update(['return_status_id'=>$request->return_status]);
            return $this->processResponse('return_status_update',null,'success',$message);
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function paymentStatus(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $order = $this->orders->find($request->order_id);
            $payment = $this->orders->togglePaymentStatus($order);
            $data = array(
                'payment_status_id' => $payment->payment_status,
                'payment_status' => $payment->payment_status == 1 ? 'Paid' : 'Un-Paid'
            );

            return $this->processResponse('payment_status_update',$data,'success','Payment Status Update');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function pdfSave(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $order_id = $request->order_id;
            $img = str_replace('data:image/jpeg;base64,', '', $request->file);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $folderPath = base_path().'/public/images/order/';
            $file =  $order_id.time() . '.pdf';
            $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
            $image = $success ? 'images/order/'.$file : 'No PDF found';
            $data = array(
                'invoice_file' => $image,
            );
            Order::where('id',$order_id)->update($data);
            return $this->processResponse('order_pdf',$data,'success','Order Pdf');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
    
}
