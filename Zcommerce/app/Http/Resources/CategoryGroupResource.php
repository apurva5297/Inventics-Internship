<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryGroupResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'image_link' => $this->image_link,
            'description' => $this->description,
            'icon' => $this->icon,
            'order' => $this->order,
        ];
    }
}
