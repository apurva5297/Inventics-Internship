<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlipkartAdsPayment extends Model
{
    use SoftDeletes;

    protected $table = 'flipkart_ads_payments';

    protected $fillable = [
        'shop_id',
        'marketplace_id',
    	'neft_id',	
    	'date',	
    	'satlement_value',	
    	'type',	
    	'campaign_id_transaction_id',	
    	'wallet_redeem',	
    	'wallet_redeem_reversal',	
    	'wallet_topup',	
    	'wallet_refund',	
    	'taxes'
    ];

    public function Shop()
    {
    	return $this->belongsTo(Shop::class);
    }
}
