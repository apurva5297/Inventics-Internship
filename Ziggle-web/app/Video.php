<?php

namespace App;

class Video extends BaseModel
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videos';

   public function customer()
   {
       return $this->belongsTo(Customer::class);
   }
}
