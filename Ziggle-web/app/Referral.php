<?php

namespace App;

class Referral extends BaseModel
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refer_list';

   public function customer()
   {
       return $this->belongsTo(Customer::class);
   }
}
