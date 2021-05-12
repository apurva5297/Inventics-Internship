<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceModule extends Model
{
    protected $table = 'marketplace_modules';

    // public function Marketplace()
    // {
    // 	return $this->belongsTo(Marketplace::class);
    // }

    public function MarketplaceModuleMapping()
    {
        return $this->hasMany(MarketplaceModuleMapping::class);
    }
}
