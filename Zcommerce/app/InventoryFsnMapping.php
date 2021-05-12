<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryFsnMapping extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invetory_marketplace_mapping_fsn';

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
        'product_title',
        'processing_errors_if_any',
        'seller_sku_id',
        'mrp',
        'your_selling_price',
        'ignore_warnings',
        'usual_price',
        'local_delivery_charge_to_customer',
        'zonal_delivery_charge_to_customer',
        'national_delivery_charge_to_customer',
        'system_stock_count',
        'your_stock_count',
        'procurement_sla',
        'listing_status',
        'inactive_reason',
        'fulfillment_by',
        'package_length',
        'package_breadth',
        'package_height',
        'package_weight',
        'procurement_type',
        'hsn',
        'tax_code',
        'luxury_cess_tax_rate',
        'listing_archival',
        'manufacturer_details',
        'importer_details',
        'packer_details',
        'iso_code',
        'date_of_manufacture',
        'shelf_life_in_months',
        'flipkart_plus',
    ];

    public function Inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
