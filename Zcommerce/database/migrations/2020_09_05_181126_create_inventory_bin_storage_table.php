<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryBinStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_bin_storage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('inventory_id');
            $table->string('qty');
            $table->string('bin_id');
            $table->string('bin_code');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('inventory_bin_storage');
    }
}
