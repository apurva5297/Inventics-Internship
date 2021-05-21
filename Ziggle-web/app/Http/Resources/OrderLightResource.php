<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'customer_id' => $this->customer_id,
            'dispute_id' => optional($this->dispute)->id,
            'order_status_id'=>$this->order_status_id,
            'order_status' => $this->orderStatus(True),
            'payment_status' => $this->paymentStatusName(True),
            'message_to_customer' => $this->message_to_customer,
            'total' => get_formated_currency($this->total, config('system_settings.decimals', 2)),
            'shipping' => get_formated_currency($this->shipping, config('system_settings.decimals', 2)),
            'taxes' => $this->taxes ? get_formated_currency($this->taxes, config('system_settings.decimals', 2)) : Null,
            'grand_total' => get_formated_currency($this->grand_total, config('system_settings.decimals', 2)),
            'grand_total_raw' => $this->grand_total,
            'order_date' => date('F j, Y', strtotime($this->created_at)),
            'shipping_date' => $this->shipping_date ? date('F j, Y', strtotime($this->shipping_date)) : Null,
            'delivery_date' => $this->delivery_date ? date('F j, Y', strtotime($this->delivery_date)) : Null,
            'goods_received' => $this->goods_received,
            // 'feedback_given' => (bool) $this->feedback_id,
            'can_evaluate' => $this->canEvaluate(),
            'tracking_id' => $this->tracking_id,
            'tracking_url' => $this->getTrackingUrl(),
            'shop' => new ShopLightResource($this->shop),
            'items' => OrderItemResource::collection($this->inventories),
        ];
    }
}