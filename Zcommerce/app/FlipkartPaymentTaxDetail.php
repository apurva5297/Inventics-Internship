<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlipkartPaymentTaxDetail extends Model
{
    use SoftDeletes;

    protected $table = 'flipkart_payment_tax_details';

    protected $fillable = [
        'shop_id',
        'marketplace_id',
    	'service_type',	
    	'neft_id',	
    	'order_item_listing_id_campign_id_transaction_id',	
    	'recall_id',	
    	'warehouse_state_code',	
    	'fee_name',	
    	'fee_amount_new',	
    	'cgst_rate',	
    	'sgst_rate',	
    	'igst_rate',	
    	'cgst_amount',	
    	'sgst_amount',	
    	'igst_amount',	
    	'fee_amount_old',	
    	'service_tax_rate',	
    	'kkc_rate',	
    	'sbc_rate',	
    	'service_tax_amount',	
    	'kkc_amount',	
    	'sbc_amount',	
    	'total_tax'	
    ];

    public function Shop()
    {
    	return $this->belongsTo(Shop::class);
    }
}
