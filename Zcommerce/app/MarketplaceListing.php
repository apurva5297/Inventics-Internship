<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceListing extends Model
{
    protected $table = 'marketplace_listings';

    protected $fillable = ['id','inventory_id','seller_sku','marketplace_listing_id','marketplace_id'];

    public function Inventory()
    {
    	return $this->belongsTo(Inventory::class);
    }

    public function MarketPlace()
    {
    	return $this->belongsTo(MarketPlace::class);
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
