<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryFlipkartListingIdMapping extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invetory_marketplace_listing_id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'inventory_id',
        'marketpalce_id',
        'flipkart_serial_number',
        'listing_id',
        'sub_category',
        'product_code',
        'seller_sku_id',
        'mrp',
        'your_selling_price',
       
    ];
}
