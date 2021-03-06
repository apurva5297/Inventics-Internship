<?php

namespace App\Http\Resources;

use App\Helpers\ListHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'product_id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'brand' => $this->brand,
            'sku' => $this->sku,
            'condition' => $this->condition,
            'condition_note' => $this->condition_note,
            'description' => $this->description,
            'key_features' => $this->key_features,
            'stock_quantity' => $this->stock_quantity,
            'sale_price' => round($this->sale_price),
            'offer_price' => $this->offer_price,
            'discount' => round($this->offer_price),
            'unit' => 'Piece',
            'single_pc'=>'yes',
            "pack_of_3"=> "S,L,XXL",
            "pack_of_5"=> "S,M,L,XL,XXL",
            "discount_type"=> "percent",
            "shipping_cost"=> "60",
            "current_stock"=> "{\"S\":\"10\",\"M\":\"10\",\"L\":\"10\",\"XL\":\"10\",\"XXL\":\"10\"}",
            'offer_start' => (string) $this->offer_start,
            'offer_end' => (string) $this->offer_end,
            'free_shipping' => $this->free_shipping,
            'shipping_weight' => $this->shipping_weight,
            'min_order_quantity' => $this->min_order_quantity,
            'linked_items' => ListHelper::linked_items($this),
            'stuff_pick' => $this->stuff_pick,
            'feedbacks_count' => $this->feedbacks_count,
            'rating' => $this->feedbacks->avg('rating'),
            'feedbacks' => $this->feedbacks,
            'product' => $this->product,
            'attribute_values' => $this->attributeValues,
            'images' => ImageResource::collection($this->images),
            // 'variants' => ListHelper::variants_of_product($this, $this->shop_id),
            'margin'=>100,

        ];
    }
}

