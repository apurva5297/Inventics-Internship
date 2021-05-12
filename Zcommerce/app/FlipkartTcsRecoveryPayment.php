<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlipkartTcsRecoveryPayment extends Model
{
    use SoftDeletes;

    protected $table = 'flipkart_tcs_recovery_payments';

    protected $fillable = [
        'shop_id',
        'marketplace_id',
    	'neft_id',	
    	'satlement_type',	
    	'satlement_value',	
    	'transaction_id',	
    	'transaction_date',	
    	'recovery_month'	
    ];

    public function Shop()
    {
    	return $this->belongsTo(Shop::class);
    }
}
