<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class MarketPlaceFlipkartWareHouseMapping extends Model
{
    use Imageable;

    protected $table = 'marketplace_flipkart_warehouse';

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
            'warehouse_id',
            'description',
            'active'
        ];
}
