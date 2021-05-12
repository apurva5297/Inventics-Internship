<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryBinStorage extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_bin_storage';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
     protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'inventory_id',
        'qty',
        'bin_id',
        'bin_code',
    ];
}
