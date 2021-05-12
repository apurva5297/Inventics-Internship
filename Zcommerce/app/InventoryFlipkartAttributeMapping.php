<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryFlipkartAttributeMapping extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invetory_marketplace_flipkart_attribute';

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
        'qc_status',
        'qc_failed_reason', 
        'flipkart_product_link', 
        'product_data_status', 
        'disapproval',
        'seller_sku_id', 
        'brand',
        'style_code', 
        'size',
        'sleeve_style', 
        'occasion',
        'ideal_for', 
        'pattern', 
        'color', 
        'pack_of', 
        'brand_color', 
        'brand_fabric', 
        'type',
        'neck_collar', 
        'fit',
        'suitable_for', 
        'main_image_url', 
        'other_image_url_1', 
        'other_image_url_2', 
        'other_image_url_3', 
        'other_image_url_4', 
        'other_image_url_5', 
        'main_palette_image_url', 
        'group_id',
        'size_for_inwarding', 
        'top_length_1',
        'ornamentation_type',
        'fabric_care',
        'model_name',
        'belt_included', 
        'other_details', 
        'sales_package', 
        'description', 
        'search_keywords', 
        'key_features',
        'video_url',
        'warranty_summary', 
        'warranty_service_type',
        'external_identifier', 
        'trend',
        'ean_upc', 
        'sleeve_length',
        'pattern_print_type', 
        'pattern_coverage', 
        'detail_placement', 
        'transparency',
        'dummy_length', 
        'secondary_color', 
        'trend_aw_16',
        'supplier_image', 
        'applique_type', 
        'checkered_type', 
        'style_of_the_sleeves', 
        'tops_length',
        'dyed_type', 
        'colorblock_type', 
        'color_shade',
        'surface_styling', 
        'sheer',
    ];
}
