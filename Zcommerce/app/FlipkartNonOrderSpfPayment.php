<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlipkartNonOrderSpfPayment extends Model
{
    use SoftDeletes;

    protected $table = 'flipkart_non_order_spf_payments';

    protected $fillable = [
        'shop_id',
        'marketplace_id',
    	'neft_id',	
    	'date',	
    	'satlement_value',	
    	'claim_id',	
    	'protection_reason',	
    	'seller_sku',	
    	'fsn',	
    	'selling_price',	
    	'warehouse_id'	
    ];

    public function Shop()
    {
    	return $this->belongsTo(Shop::class);
    }
}
