<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Shop\ShopRepository;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;

class ShopController extends Controller
{
	use ProcessResponseTrait,ValidationTrait;

    public function __construct(ShopRepository $shop)
    {
    	$this->shop = $shop;
    }
    public function myCustomerList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$customer_list = array();
        	$shop_details = $this->shop->customerList($users->shop_id);
        	foreach($shop_details->orders as $shop)
        	{
        		$customer_list[] = array(
        			'name' => $shop->customer->name,
        			'email' => $shop->customer->email,
        			'phone' => $shop->customer->phone,
        			'dob' => $shop->customer->dob,
        			'gender' => $shop->customer->sex,
        		);
        	}

        	return $this->processResponse('customer_list',$customer_list,'success','Customer List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
}
