<?php

namespace App\Repositories\Coupon;

use Auth;
use App\Coupon;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class EloquentCoupon extends EloquentRepository implements BaseRepository, CouponRepository
{
	protected $model;

	public function __construct(Coupon $coupon)
	{
		$this->model = $coupon;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->withCount(['customers', 'shippingZones'])->get();

        return $this->model->withCount(['customers', 'shippingZones'])->get();
    }

    public function customer_list($coupon)
    {
        $customers = $coupon->customers;

        $results = [];
        foreach ($customers as $customer)
            $results[$customer->id] = get_formated_cutomer_str($customer);

        return $results;
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->onlyTrashed()->get();

        return parent::trashOnly();
    }

    public function store(Request $request)
    {
        $coupon = parent::store($request);

        if ($request->input('customer_list'))
            $this->syncCustomers($coupon, $request->input('customer_list'));

        if ($request->input('zone_list'))
            $this->syncZones($coupon, $request->input('zone_list'));

        return $coupon;
    }

    public function update(Request $request, $id)
    {
        $coupon = parent::update($request, $id);

        $this->syncCustomers($coupon, $request->input('customer_list') ?: []);

        $this->syncZones($coupon, $request->input('zone_list') ?: []);

        return $coupon;
    }

    public function syncCustomers($coupon, array $ids)
    {
        $coupon->customers()->sync($ids);
    }

    public function syncZones($coupon, array $ids)
    {
        $coupon->shippingZones()->sync($ids);
    }

    public function couponList(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $start = ($page-1)*10;
        $order_by = $request->order_by ? $request->order_by : 'desc';
        return Coupon::withCount(['customers', 'shippingZones'])->where('shop_id',$request->shop_id)
                        ->offset($start)
                        ->take(10)
                        ->orderBy('id',$order_by)
                        ->get();
    }

    public function couponCreate(Request $request)
    {
        $data = array(
            'shop_id' => $request->shop_id,
            'name' => $request->code,
            'active' => $request->active ? $request->active : 1,
            'code' => $request->code,
            'value' => $request->value,
            'type' => $request->type,
            'min_order_amount' => $request->min_order_amount,
            'ending_time' => $request->ending_time,
        );
        return Coupon::create($data);
    }

    public function couponView(Request $request)
    {
        $coupon_id = $request->coupon_id;
        return Coupon::where('id',$coupon_id)->first();
    }

    public function couponUpdate(Request $request)
    {
        $data = array(
            'shop_id' => $request->shop_id,
            'name' => $request->code,
            'active' => $request->active ? $request->active : 1,
            'code' => $request->code,
            'value' => $request->value,
            'type' => $request->type,
            'quantity' => $request->quantity ? $request->quantity : 100000,
            'min_order_amount' => $request->min_order_amount,
            'quantity_per_customer' => $request->quantity_per_customer ? $request->quantity_per_customer : 1,
            'ending_time' => $request->ending_time,
        );
        return Coupon::where('id',$request->coupon_id)->update($data);
    }

    public function couponDelete(Request $request)
    {
        Coupon::where('id',$request->coupon_id)->delete();
        return true;
    }
}