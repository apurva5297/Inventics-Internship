<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorySubGroupResource extends JsonResource
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
            'category_id'=>$this->id,
            'category_group_id' => $this->category_group_id,
            'category_name'=>$this->name,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
     }
}


