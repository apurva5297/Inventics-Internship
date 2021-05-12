<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvetoryMarketplaceMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invetory_marketplace_mapping_fsn', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('inventory_id');
            $table->string('marketpalce_id');
            $table->longtext('flipkart_serial_number')->nullable();
            $table->longtext('listing_id')->nullable();
            $table->longtext('sub_category')->nullable();
            $table->longtext('product_title')->nullable();
            $table->longtext('processing_errors_if_any')->nullable();
            $table->longtext('seller_sku_id')->nullable();
            $table->longtext('mrp')->nullable();
            $table->longtext('your_selling_price')->nullable();
            $table->longtext('ignore_warnings')->nullable();
            $table->longtext('usual_price')->nullable();
            $table->longtext('local_delivery_charge_to_customer')->nullable();
            $table->longtext('zonal_delivery_charge_to_customer')->nullable();
            $table->longtext('national_delivery_charge_to_customer')->nullable();
            $table->longtext('system_stock_count')->nullable();
            $table->longtext('your_stock_count')->nullable();
            $table->longtext('procurement_sla')->nullable();
            $table->longtext('listing_status')->nullable();
            $table->longtext('inactive_reason')->nullable();
            $table->longtext('fulfillment_by')->nullable();
            $table->longtext('package_length')->nullable();
            $table->longtext('package_breadth')->nullable();
            $table->longtext('package_height')->nullable();
            $table->longtext('package_weight')->nullable();
            $table->longtext('procurement_type')->nullable();
            $table->longtext('hsn')->nullable();
            $table->longtext('tax_code')->nullable();
            $table->longtext('luxury_cess_tax_rate')->nullable();
            $table->longtext('listing_archival')->nullable();
            $table->longtext('manufacturer_details')->nullable();
            $table->longtext('importer_details')->nullable();
            $table->longtext('packer_details')->nullable();
            $table->longtext('iso_code')->nullable();
            $table->longtext('date_of_manufacture')->nullable();
            $table->longtext('shelf_life_in_months')->nullable();
            $table->longtext('flipkart_plus')->nullable();
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
        Schema::dropIfExists('invetory_marketplace_mapping_fsn');
    }
}
