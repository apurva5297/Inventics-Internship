<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceReportTableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_report_table_field', function (Blueprint $table) {
            $table->increments('id');
            $table->text('shop_id')->nullable();
            $table->text('marketpalce_id')->nullable();
            $table->text('table_name')->nullable();
            $table->text('table_id')->nullable();
            $table->text('title')->nullable();
            $table->text('table_field')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('marketplace_report_table_field');
    }
}
