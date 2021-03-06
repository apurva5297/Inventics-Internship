<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $table = 'bank_details';

    protected $fillable = ['bank_name',	'account_holder_name',	'account_number',	'ifsc',	'bankable_type',	'bankable_id'];
}
