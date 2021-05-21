<?php

namespace App;

class Catalog extends BaseModel
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalogs';

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
