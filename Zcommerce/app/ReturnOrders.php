<?php

namespace App;

use Carbon\Carbon;
use App\Common\Loggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnOrders extends Model
{
    use SoftDeletes, Loggable;

    const PAYMENT_STATUS_UNPAID             = 1;       //Default
    const PAYMENT_STATUS_PENDING            = 2;
    const PAYMENT_STATUS_PAID               = 3;      //All status before paid value consider as unpaid
    const PAYMENT_STATUS_INITIATED_REFUND   = 4;
    const PAYMENT_STATUS_PARTIALLY_REFUNDED = 5;
    const PAYMENT_STATUS_REFUNDED           = 6;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'return_orders';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'shipping_date', 'delivery_date', 'payment_date'];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'return_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'order_number',
                        'return_order_id',
                        'shop_id',
                        'customer_id',
                        'ship_to',
                        'shipping_zone_id',
                        'shipping_rate_id',
                        'packaging_id',
                        'item_count',
                        'quantity',
                        'shipping_weight',
                        'taxrate',
                        'total',
                        'wallet_amount',
                        'discount',
                        'sub_total',
                        'shipping',
                        'packaging',
                        'handling',
                        'taxes',
                        'grand_total',
                        'billing_address',
                        'shipping_address',
                        'shipping_date',
                        'delivery_date',
                        'tracking_id',
                        'coupon_id',
                        'carrier_id',
                        'message_to_customer',
                        'send_invoice_to_customer',
                        'admin_note',
                        'buyer_note',
                        'payment_method_id',
                        'payment_date',
                        'payment_status',
                        'return_status_id',
                        'goods_received',
                        'approved',
                        'feedback_id',
                        'disputed',
                        'email',
                        'tracking_file',
                    ];

    /**
     * Get the country associated with the order.
     */
    public function shipTo()
    {
        return $this->belongsTo(Country::class, 'ship_to');
    }

    /**
     * Get the customer associated with the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => trans('app.guest_customer'),
        ]);
    }

    /**
     * Get the shop associated with the order.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }


    /**
     * Get the inventories for the order.
     */
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'return_order_items')
        ->withPivot('item_description', 'quantity', 'unit_price','feedback_id')->withTimestamps();
    }

    public function ReturnStatus()
    {
        return $this->belongsTo(ReturnStatus::class);
    }
}
