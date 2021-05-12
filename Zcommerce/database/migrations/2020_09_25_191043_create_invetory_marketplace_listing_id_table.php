<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvetoryMarketplaceListingIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invetory_marketplace_listing_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('inventory_id');
            $table->string('marketpalce_id');
            $table->longtext('flipkart_serial_number')->nullable();
            $table->longtext('listing_id')->nullable();
            $table->longtext('sub_category')->nullable();
            $table->longtext('product_code')->nullable();
            $table->longtext('seller_sku_id')->nullable();
            $table->longtext('mrp')->nullable();
            $table->longtext('your_selling_price')->nullable();
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
        Schema::dropIfExists('invetory_marketplace_listing_id');
    }
}
