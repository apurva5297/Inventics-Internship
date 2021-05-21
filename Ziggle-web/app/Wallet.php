<?php

namespace App;

class Wallet extends BaseModel
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wallets';

   public function customer()
   {
       return $this->belongsTo(Customer::class);
   }
}
