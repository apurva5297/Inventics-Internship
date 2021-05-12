<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
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
            'product_id' => $this->id,
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'condition' => $this->condition,
            'sale_price' => round($this->sale_price),
            'unit' => 'Piece',
            "current_stock"=> "{\"S\":\"10\",\"M\":\"10\",\"L\":\"10\",\"XL\":\"10\",\"XXL\":\"10\"}",
            'discount' => round($this->offer_price),
            /*'current_stock'=>$this->stock_quantity,*/
            'offer_start' => (string) $this->offer_start,
            'offer_end' => (string) $this->offer_end,
            'stuff_pick' => $this->stuff_pick,
            'hot_item' => $this->orders_count >= config('system.popular.hot_item.sell_count', 3) ? true : false,
            'rating' => $this->feedbacks->avg('rating'),
            'feedbacks' => $this->feedbacks,
            'image' => (new ImageResource($this->image))->size('medium'),
        ];
    }
}
