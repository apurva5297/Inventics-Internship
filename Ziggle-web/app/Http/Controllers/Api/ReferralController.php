<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use Illuminate\Http\Request;
use App\Wallet;
use App\Transaction;
use App\Customer;
use App\Order;
use App\Payment;
use Carbon\Carbon;
use Config;
use DB;  

class ReferralController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
  

    public function referral_code(Request $request)
    {
        $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
        if($cust)
        {
            $customer_referral_code = Customer::select('referral_code')->where('id',$cust->user_id)->first();

            return $this->processResponse('Customer_referral_code',$customer_referral_code->referral_code,'success','Customer referral code show successfully!!');
           }
        else
        return $this->processResponse(null,null,'error','Enter correct login details');
    }
  
}


