<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricelistMappingInvetoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricelist_mapping_invetory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_id');
            $table->string('pricelist_id');
            $table->string('inventory_id');
            $table->string('price');
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
        Schema::dropIfExists('pricelist_mapping_invetory');
    }
}
