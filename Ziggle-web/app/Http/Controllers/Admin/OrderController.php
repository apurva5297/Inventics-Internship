<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Order;
use Carbon;
use App\Bonus;
use App\Referral;
use App\Transaction;
use App\Wallet;
use App\Customer;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Events\Order\OrderPaid;
use App\Events\Order\OrderCreated;
use App\Events\Order\OrderUpdated;
use App\Events\Order\OrderFulfilled;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Storage;
// use App\Events\Order\OrderPaymentFailed;
use App\Repositories\Order\OrderRepository;
use App\Http\Requests\Validations\CreateOrderRequest;
use App\Http\Requests\Validations\FulfillOrderRequest;
use App\Http\Requests\Validations\CustomerSearchRequest;

// use App\Services\PdfInvoice;
// use Konekt\PdfInvoice\InvoicePrinter;

class OrderController extends Controller
{
    use Authorizable;

    private $model_name;

    private $order;

    /**
     * construct
     */
    public function __construct(OrderRepository $order)
    {
        parent::__construct();
        $this->model_name = trans('app.model.order');
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->all();

        $archives = $this->order->trashOnly();

        return view('admin.order.index', compact('orders', 'archives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCutomer()
    {
        return view('admin.order._search_customer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['customer'] = $this->order->getCustomer($request->input('customer_id'));

        $data['cart_lists'] = $this->order->getCartList($request->input('customer_id'));

        if ($request->input('cart_id')) {
            $data['cart'] = $this->order->getCart($request->input('cart_id'));
        }

        return view('admin.order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $order = $this->order->store($request);

       // event(new OrderCreated($order));

        return redirect()->route('admin.order.order.index')
        ->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->order->find($id);

        $this->authorize('view', $order); // Check permission

        $address = $order->customer->primaryAddress();

        return view('admin.order.show', compact('order', 'address'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $order = $this->order->find($id);

        $this->authorize('view', $order); // Check permission

        $order->invoice('D'); // Download the invoice
    }

    /**
     * Show the fulfillment form for the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fulfillment($id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        return view('admin.order._fulfill', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        return view('admin.order._edit', compact('order'));
    }

    /**
     * Fulfill the order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function fulfill(FulfillOrderRequest $request, $id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        $this->order->fulfill($request, $order);

      //  event(new OrderFulfilled($order, $request->filled('notify_customer')));

        if(config('shop_settings.auto_archive_order') && $order->isPaid()){
            $this->order->trash($id);

            return redirect()->route('admin.order.order.index')
            ->with('success', trans('messages.fulfilled_and_archived'));
        }

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * updateOrderStatus the order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $order = $this->order->find($id);
        $customer_id = Order::select('customer_id')->where('id',$order->id)->first();
        $this->authorize('fulfill', $order); // Check permission

        $this->order->updateOrderStatus($request, $order);
        switch($request->order_status_id)
        {
            case 1:
                $status_name = 'Waiting for payment';
            break;
            case 2:
                $status_name = 'Payment error';
            break;
            case 3:
                $status_name = 'Confirmed';
            case 4:
                $status_name = 'Fulfilled';
            break;
            case 5:
                $status_name = 'Awaiting delivery';
            break;
            case 6:
                $status_name = 'Delivered';
            break;
            case 7:
                $status_name = 'Returned';
            break;
            case 8:
                $status_name= 'Cancelled';
            break;
            default:
                $status_name = 'Pending';
        }

        if($customer_id)
        {
         $message = ' Order Shipped Successfully , Please Check out the App';
         $types = 'order_type';
         $tp = $customer_id->customer_id;
         $chat = 'Hurry!! Your order is '.$status_name.'';
         $id = $order->id;
         $this->notify($tp,$chat,$message,$types,$id);
        }
        
      
        //Save data into bonus table
        if($request->order_status_id == 6)
        {
        //Refer payment
        $refer_coupon = Customer::select('referred_by')->where('id',$customer_id->customer_id)->first();
        if($refer_coupon->referred_by !=null)
        {
            $customer_refer_id = Customer::select('id','referral_code')->where('referral_code',$refer_coupon->referred_by)->first();
            $commision_amount = ($order->total)*(10/100);
            $wallet = Wallet::where('customer_id',$customer_refer_id->id)->first();
         
            if($wallet == null)
            {
                $increment = $commision_amount;
                $curr_bal = $increment;
                $wallet = new Wallet;
                $wallet->customer_id = $customer_refer_id->id;
                $wallet->balance = $commision_amount;
                $wallet->save();
            }
            else
            {
                $pre_bal = $wallet->balance;
                $increment = $commision_amount;
                $curr_bal = $pre_bal + $increment;
                $wallet->balance = $curr_bal;
                $wallet->save();
            }
            $transaction = new Transaction;
            $transaction->wallet_id = $wallet->id;
            $transaction->amount = $increment;
            $transaction->transaction_id = time();
            $transaction->source = 'Referral';
            $transaction->trans_type = 'credit';
            $transaction->balance = $curr_bal ;
            $transaction->save();
            
            //Save data in refer list table
            DB::table('refer_list')->insert(
                ['cuid' => $customer_id->customer_id,
                 'refered_by' => $customer_refer_id->id ,
                 'refer_coupon_name'=>$customer_refer_id->referral_code,
                 'status'=>'active',
                 'source'=>'android',
                 'created_at'=> DB::raw('CURRENT_TIMESTAMP'), 
                 'updated_at'=>DB::raw('CURRENT_TIMESTAMP') ,
                 'first_time'=> 1,
                 'earning'=>$commision_amount,
                 'source'=>'android',
                 'hioid'=>$id,
                 'total'=>$order->total,
                 'grand_total'=>$order->grand_total,
                 'margin'=>$order->margin,
                 'earning_status'=>'approved',
                ]
            );

            if($customer_id)
            {
             $message = ' Order Shipped Successfully , Please Check out the App';
             $types = 'order_type';
             $tp = $customer_refer_id->id;
             $chat = 'Hurry!! Your get commission from your referral '.$order->customer->name.'.Check your wallet.' ;
             $id = $order->id;
             $this->notify($tp,$chat,$message,$types,$id);
            }
        }

        //Bonus Add
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
        ->where('customer_id',$customer_id->customer_id)
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

        $bonus_id = DB::table('bonuses')->select('id')->where('order_id',$order->id)->where('bonus_type','Bonus Paid')->first();
      
        if($bonus_id == null)
        {
            $bonus = new Bonus;
            $bonus->customer_id = $customer_id->customer_id;
            $bonus->order_id = $order->id;
            $bonus->order_status = $status_name;
            $bonus->start_date = $start_day;
            $bonus->today_date = $today;
            $bonus->end_date = $end_day;
            $bonus->bonus_type = 'Bonus Paid';
            $bonus->bonus_outstanding = 0;
            $bonus->bonus_paid  = $level_bonus;
            $bonus->left_amount = 0;
            $bonus->save();
        }
        else
        {  
            $bonus = Bonus::find($bonus_id->id);
            $bonus->customer_id = $customer_id->customer_id;
            $bonus->order_id = $order->id;
            $bonus->order_status = $status_name;
            $bonus->start_date = $start_day;
            $bonus->today_date = $today;
            $bonus->end_date = $end_day;
            $bonus->bonus_type = 'Bonus Paid';
            $bonus->bonus_outstanding = 0;
            $bonus->bonus_paid  = $level_bonus;
            $bonus->left_amount = 0;
            $bonus->save();
        }
        
        //Update bonus table for outstanding bonus
            DB::table('bonuses')
            ->where('order_id',$order->id)
            ->where('bonus_type','Outstanding Bonus')
            ->update(['bonus_outstanding'=>0]);

        //Update Wallet with commission
        $wallet = Wallet::where('customer_id',$customer_id->customer_id)->first();
        if($wallet == null)
        {
            $increment = $order->margin;
            $curr_bal = $increment;
            $wallet = new Wallet;
            $wallet->customer_id = $customer_id->customer_id;
            $wallet->balance = $order->margin;
            $wallet->save();
        }
        else
        {
            $pre_bal = $wallet->balance;
            $increment = $order->margin;
            $curr_bal = $pre_bal + $increment;
            $wallet->balance = $curr_bal;
            $wallet->save();
        }
        $transaction = new Transaction;
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $increment;
        $transaction->transaction_id = time();
        $transaction->source = 'Bonus earned by order'.''.$order->order_number;
        $transaction->trans_type = 'credit';
        $transaction->balance = $curr_bal ;
        $transaction->save();
        
        //Push notifications to the same user about wallet addition.
            if($customer_id)
            {
            $message = ' Order Shipped Successfully , Please Check out the App';
            $types = 'order_type';
            $tp = $customer_id->customer_id;
            $chat = 'Hurry!! Your get commission to your wallet of Rs.'.$order->margin.'.Check your wallet.' ;
            $id = $order->id;
            $this->notify($tp,$chat,$message,$types,$id);
            }

        }

       // event(new OrderUpdated($order, $request->filled('notify_customer')));

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

  
    public function adminNote($id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        return view('admin.order._edit_admin_note', compact('order'));
    }
    public function saveAdminNote(Request $request, $id)
    {
        $order = $this->order->find($id);

        // $this->authorize('fulfill', $order); // Check permission

        $this->order->updateAdminNote($request, $order);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, $id)
    {
        $this->order->trash($id);

        return redirect()->route('admin.order.order.index')
        ->with('success', trans('messages.archived', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->order->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Toggle Payment Status of the given order, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePaymentStatus(Request $request, $id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        $this->order->togglePaymentStatus($order);

        if($order->payment_status == Order::PAYMENT_STATUS_PAID) {
          //  event(new OrderPaid($order));
        }
        else {
            //event(new OrderUpdated($order));
        }

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }
}


