<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasuringUnit extends Model
{
    protected $table = 'measuring_units';

    protected $fillabel = ['name', 'symbol', 'status'];

    public function Inventory()
    {
    	return $this->hasMany(Inventory::class);
    }
}
