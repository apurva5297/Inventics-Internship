<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FlipkartPreviousOrder extends Model
{
    use SoftDeletes;

    protected $table = 'flipkart_previous_orders';

    protected $fillable = [
    	'shop_id', 
	    'order_item_id', 
	    'order_id', 
	    'fulfilment_source', 
	    'fulfilment_type', 
	    'order_date', 
	    'order_approval_date', 
	    'order_item_status', 
	    'sku', 
	    'fsn', 
	    'product_title', 
	    'quantity', 
	    'serial_no_imei', 
	    'delivery_logistic_partner', 
	    'pickup_logistic_partner', 
	    'delivery_tracking_id', 
	    'forward_logistic_form', 
	    'forword_logistic_form_no', 
	    'order_cancellation_date', 
	    'cancellation_reason', 
	    'cancellation_sub_reason', 
	    'order_return_approval_date', 
	    'return_id', 'return_reason', 
	    'return_sub_reason', 
	    'procurement_dispatch_sla', 
	    'dispatch_after_date', 
	    'dispatch_by_date',
	    'order_ready_for_dispatch_on_date',	
	    'dispatched_date',	
	    'dispatched_sla_breached',	
	    'seller_pickup_reattempts',	
	    'delivery_sla',	
	    'delivery_by_date',	
	    'delivery_sla_breached',	
	    'delivery_serice_completation_date',	
	    'service_by_date',	
	    'service_completaion_sla',
	    'service_sla_breached'
	];

	public function Shop()
	{
		return $this->belongsTo(Shop::class);
	}
}
