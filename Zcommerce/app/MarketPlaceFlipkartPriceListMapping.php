<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class MarketPlaceFlipkartPriceListMapping extends Model
{
    use Imageable;

    protected $table = 'marketplace_flipkart_pricelist';

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
            'pricelist_id',
            'description',
            'active'
        ];
}
