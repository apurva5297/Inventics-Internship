<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Coupon\CouponRepository;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;

class OffersController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function __construct(CouponRepository $coupon)
    {
    	$this->coupon = $coupon;
    }

    public function offerList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $request->shop_id = $users->shop_id;
        	$coupon = $this->coupon->couponList($request);
        	return $this->processResponse('coupon_list',$coupon,'success','Coupon List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function offerStore(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $request->shop_id = $users->shop_id;
            $coupon = $this->coupon->couponCreate($request);

            return $this->processResponse('coupon_created',$coupon,'success','Coupon Created Successfully');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function offerView(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $coupon = $this->coupon->couponView($request);

            return $this->processResponse('coupon_view',$coupon,'success','Coupon View');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');   
    }

    public function offerUpdate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $request->shop_id = $users->shop_id;
            $coupon = $this->coupon->couponUpdate($request);

            return $this->processResponse('coupon_updated',$coupon,'success','Coupon updated Successfully');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function offerDelete(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $coupon = $this->coupon->couponDelete($request);

            return $this->processResponse('coupon_delete',null,'success','Coupon Deleted Successfully');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
}
