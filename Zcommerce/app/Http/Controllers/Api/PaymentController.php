<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\User;
use App\Shop;
use App\Config;
use App\PaymentMethod;
use App\ConfigPaytm;
use DB;

class PaymentController extends Controller
{
	use ProcessResponseTrait,ValidationTrait;

    public function availablePaymentMethod(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $payment_methods = PaymentMethod::where('enabled',1)->get();
            return $this->processResponse('available_payment_method',$payment_methods,'success','Available Payments');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function showPaytmDetail(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $paytm_detail = ConfigPaytm::where(['shop_id'=>$users->shop_id, 'own_paytm'=>'Yes'])->first();

            return $this->processResponse('paytm_details',$paytm_detail,'success','Paytm account details');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function updatePaytmDetail(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            if($request->own_paytm == 'Yes')
            {
                $data = array(
                    'shop_id' => $users->shop_id,
                    'm_id'  => $request->m_id,
                    'm_key' => $request->m_key,
                    'channel_id' => $request->channel_id,
                    'own_paytm' => $request->own_paytm,
                );
            }
            else
            {
                $data = array(
                    'shop_id' => $users->shop_id,
                    'own_paytm' => 'No',
                );
            }
            ConfigPaytm::insert($data);
            return $this->processResponse('update_paytm_detail',$data,'success','Paytm details updated');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function decativatePaytm(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            ConfigPaytm::where('shop_id',$users->shop_id)->delete();
            DB::table('shop_payment_methods')->where(['shop_id'=>$users->shop_id,'payment_method_id'=>8])->delete();
            return $this->processResponse('paytm_deactivated',null,'success','Paytm account deactivated');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
}
