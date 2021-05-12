<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlipkartPaymentStorageRecall extends Model
{
    use SoftDeletes;

    protected $table = 'flipkart_payment_storage_recall';

    protected $fillable = [
    	'shop_id',
	    'market_place_id',
	    'neft_id',	
	    'date',	
	    'satelement_value',	
	    'service_name',	
	    'listing_id',	
	    'recall_id',	
	    'warehouse_state_code',	
	    'fsn',	
	    'market_place_fee',	
	    'taxes',	
	    'removal_fee_units',	
	    'removal_fee',	
	    'storage_fee_unit',	
	    'storage_fee',
	    'sellable_regular_storeage_unit',
	    'sellable_regular_storeage',	
	    'unsellable_regular_storeage_unit',	
	    'unsellable_regular_storeage',	
	    'sellable_longterm_1_storage_unit',	
	    'sellable_longterm_1_storage',	
	    'unsellable_longterm_1_storage_unit',	
	    'unsellable_longterm_1_storage',	
	    'sellable_longterm_2_storage_unit',	
	    'sellable_longterm_2_storage',	
	    'unsellable_longterm_2_storage_unit',	
	    'unsellable_longterm_2_storage',	
	    'product_sub_category',	
	    'dead_weight',	
	    'length_breadth_height',	
	    'volumentric_weight',	
	    'chargeable_weight_slab',	
	    'chargeable_weight_type'
	];

	public function Shop()
	{
		return $this->belongsTo(Shop::class);
	}
}
