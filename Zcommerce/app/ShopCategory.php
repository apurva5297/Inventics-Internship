<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    protected $table = 'shop_categories';

    protected $fillable = [
    	'shop_id','master_category_id','category_group_id','category_sub_group_id'
    ];

    public function Shop()
    {
    	return $this->belongsTo(Shop::class);
    }
}
