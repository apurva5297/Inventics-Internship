<?php

namespace App\Repositories\Coupon;
use Illuminate\Http\Request;

interface CouponRepository
{
    public function customer_list($coupon);

    public function syncCustomers($coupon, array $ids);

    public function couponList(Request $request);

    public function couponCreate(Request $request);

    public function couponView(Request $request);

    // public function couponUpdate(Request $request);

    // public function couponDelete(Request $request);
}