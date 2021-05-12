<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceFlipkartWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_flipkart_warehouse', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('marketpalce_id');
            $table->string('warehouse_id');
            $table->longtext('description')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('marketplace_flipkart_warehouse');
    }
}
