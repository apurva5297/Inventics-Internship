<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlipkartOrdersPayment extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marketplace_flipkart_payment';

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
        'marketpalce_id',
        'neft_id',
        'neft_type',
        'date',
        'settlement_value',
        'order_id',
        'order_item_id',
        'sale_amount',
        'total_offer_amount',
        'my_share',
        'my_share',
        'customer_shipping_amount',
        'marketplace_fee',
        'tax_collected',
        'tds',
        'taxes',
        'protection_fund',
        'refund',
        'order_date',
        'dispatch_date',
        'fulfilment_type',
        'seller_sku',
        'quantity',
        'product_sub_category',
        'additional_information',
        'return_type',
        'item_return_status',
        'sale_amount_2',
        'total_offer_amount_2',
        'tier',
        'commission_rate',
        'commission',
        'commission_fee_waiver',
        'collection_fee',
        'collection_fee_waiver',
        'fixed_fee',
        'fixed_fee_waiver',
        'no_cost_emi_fee',
        'installation_fee',
        'uninstallation_fee',
        'tech_visit_fee',
        'uninstallation_packaging_fee',
        'pick_and_pack_fee',
        'pick_and_pack_fee_waiver',
        'customer_shipping_fee_type',
        'customer_shipping_fee',
        'shipping_fee',
        'shipping_fee_waiver',
        'reverse_shipping_fee',
        'franchise_fee',
        'product_cancellation_fee',
        'service_cancellation_fee',
        'fee_discount',
        'service_cancellation_charge',
        'multipart_shipment',
        'profiler_dead_weight',
        'seller_dead_weight',
        'length_breadth_height',
        'volumetric_weight',
        'chargeable_weight_type',
        'chargeable_wt',
        'shipping_zone',
        'ids_invoice',
        'date_invoice',
        'amount_invoice',
    ];
}
