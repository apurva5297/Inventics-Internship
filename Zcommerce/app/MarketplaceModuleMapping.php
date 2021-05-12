<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceModuleMapping extends Model
{
    protected $table = 'marketplace_module_mapping';

    protected $fillable = ['marketplace_id','marketplace_module_id','mapping'];

    public function Marketplace()
    {
    	return $this->belongsTo(MarketPlace::class);
    }

    public function MarketplaceModule()
    {
    	return $this->belongsTo(MarketplaceModule::class);
    }
}
