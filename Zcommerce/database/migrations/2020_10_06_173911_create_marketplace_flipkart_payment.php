<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceFlipkartPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_flipkart_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->text('shop_id')->nullable();
            $table->text('marketpalce_id')->nullable();
            $table->text('neft_id')->nullable();
            $table->text('neft_type')->nullable();
            $table->text('date')->nullable();
            $table->text('settlement_value')->nullable();
            $table->text('order_id')->nullable();
            $table->text('order_item_id')->nullable();
            $table->text('sale_amount')->nullable();
            $table->text('total_offer_amount')->nullable();
            $table->text('my_share')->nullable();
            $table->text('customer_shipping_amount')->nullable();
            $table->text('marketplace_fee')->nullable();
            $table->text('tax_collected')->nullable();
            $table->text('taxes')->nullable();
            $table->text('protection_fund')->nullable();
            $table->text('refund')->nullable();
            $table->text('order_date')->nullable();
            $table->text('dispatch_date')->nullable();
            $table->text('fulfilment_type')->nullable();
            $table->text('seller_sku')->nullable();
            $table->text('quantity')->nullable();
            $table->text('product_sub_category')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('return_type')->nullable();
            $table->text('item_return_status')->nullable();
            $table->text('sale_amount_2')->nullable();
            $table->text('total_offer_amount_2')->nullable();
            $table->text('tier')->nullable();
            $table->text('commission_rate')->nullable();
            $table->text('commission')->nullable();
            $table->text('commission_fee_waiver')->nullable();
            $table->text('collection_fee')->nullable();
            $table->text('collection_fee_waiver')->nullable();
            $table->text('fixed_fee')->nullable();
            $table->text('fixed_fee_waiver')->nullable();
            $table->text('no_cost_emi_fee')->nullable();
            $table->text('installation_fee')->nullable();
            $table->text('uninstallation_fee')->nullable();
            $table->text('tech_visit_fee')->nullable();
            $table->text('uninstallation_packaging_fee')->nullable();
            $table->text('pick_and_pack_fee')->nullable();
            $table->text('pick_and_pack_fee_waiver')->nullable();
            $table->text('customer_shipping_fee_type')->nullable();
            $table->text('customer_shipping_fee')->nullable();
            $table->text('shipping_fee')->nullable();
            $table->text('shipping_fee_waiver')->nullable();
            $table->text('reverse_shipping_fee')->nullable();
            $table->text('franchise_fee')->nullable();
            $table->text('product_cancellation_fee')->nullable();
            $table->text('service_cancellation_fee')->nullable();
            $table->text('fee_discount')->nullable();
            $table->text('service_cancellation_charge')->nullable();
            $table->text('multipart_shipment')->nullable();
            $table->text('profiler_dead_weight')->nullable();
            $table->text('seller_dead_weight')->nullable();
            $table->text('length_breadth_height')->nullable();
            $table->text('volumetric_weight')->nullable();
            $table->text('chargeable_weight_type')->nullable();
            $table->text('chargeable_wt')->nullable();
            $table->text('shipping_zone')->nullable();
            $table->text('ids_invoice')->nullable();
            $table->text('date_invoice')->nullable();
            $table->text('amount_invoice')->nullable();
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
        Schema::dropIfExists('marketplace_flipkart_payment');
    }
}
