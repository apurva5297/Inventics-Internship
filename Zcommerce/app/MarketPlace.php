<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{	
	use Imageable;

    protected $table = 'marketplace';

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
            'name',
            'nice_name',
            'email',
            'active'
        ];

    public function MarketplaceModuleMapping()
    {
        return $this->hasMany(MarketplaceModuleMapping::class,'marketplace_id');
    }

    public function MarketplaceListing()
    {
        return $this->hasMany(MarketplaceListing::class);
    }
}
