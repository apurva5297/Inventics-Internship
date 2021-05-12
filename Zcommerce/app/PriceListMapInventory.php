<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class PriceListMapInventory extends Model
{
	use Imageable;

    protected $table = 'pricelist_mapping_invetory';

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
            'pricelist_id',
            'inventory_id',
            'price'
        ];
}
