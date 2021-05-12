<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvetoryMarketplaceAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invetory_marketplace_flipkart_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('inventory_id');
            $table->string('marketpalce_id');
            $table->longtext('flipkart_serial_number')->nullable();
            $table->longtext('qc_status')->nullable();
            $table->longtext('qc_failed_reason')->nullable();
            $table->longtext('flipkart_product_link')->nullable();
            $table->longtext('product_data_status')->nullable();
            $table->longtext('disapproval')->nullable();
            $table->longtext('seller_sku_id')->nullable();
            $table->longtext('brand')->nullable();
            $table->longtext('style_code')->nullable();
            $table->longtext('size')->nullable();
            $table->longtext('sleeve_style')->nullable();
            $table->longtext('occasion')->nullable();
            $table->longtext('ideal_for')->nullable();
            $table->longtext('pattern')->nullable();
            $table->longtext('color')->nullable();
            $table->longtext('pack_of')->nullable();
            $table->longtext('brand_color')->nullable();
            $table->longtext('brand_fabric')->nullable();
            $table->longtext('type')->nullable();
            $table->longtext('neck_collar')->nullable();
            $table->longtext('fit')->nullable();
            $table->longtext('suitable_for')->nullable();
            $table->longtext('main_image_url')->nullable();
            $table->longtext('other_image_url_1')->nullable();
            $table->longtext('other_image_url_2')->nullable();
            $table->longtext('other_image_url_3')->nullable();
            $table->longtext('other_image_url_4')->nullable();
            $table->longtext('other_image_url_5')->nullable();
            $table->longtext('main_palette_image_url')->nullable();
            $table->longtext('group_id')->nullable();
            $table->longtext('size_for_inwarding')->nullable();
            $table->longtext('top_length_1')->nullable();
            $table->longtext('ornamentation_type')->nullable();
            $table->longtext('fabric_care')->nullable();
            $table->longtext('model_name')->nullable();
            $table->longtext('belt_included')->nullable();
            $table->longtext('other_details')->nullable();
            $table->longtext('sales_package')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('search_keywords')->nullable();
            $table->longtext('key_features')->nullable();
            $table->longtext('video_url')->nullable();
            $table->longtext('warranty_summary')->nullable();
            $table->longtext('warranty_service_type')->nullable();
            $table->longtext('external_identifier')->nullable();
            $table->longtext('trend')->nullable();
            $table->longtext('ean_upc')->nullable();
            $table->longtext('sleeve_length')->nullable();
            $table->longtext('pattern_print_type')->nullable();
            $table->longtext('pattern_coverage')->nullable();
            $table->longtext('detail_placement')->nullable();
            $table->longtext('transparency')->nullable();
            $table->longtext('dummy_length')->nullable();
            $table->longtext('secondary_color')->nullable();
            $table->longtext('trend_aw_16')->nullable();
            $table->longtext('supplier_image')->nullable();
            $table->longtext('applique_type')->nullable();
            $table->longtext('checkered_type')->nullable();
            $table->longtext('style_of_the_sleeves')->nullable();
            $table->longtext('tops_length')->nullable();
            $table->longtext('dyed_type')->nullable();
            $table->longtext('colorblock_type')->nullable();
            $table->longtext('color_shade')->nullable();
            $table->longtext('surface_styling')->nullable();
            $table->longtext('sheer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invetory_marketplace_flipkart_attribute');
    }
}
