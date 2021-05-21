<?php

namespace App;

use Carbon\Carbon;
use App\Common\Taggable;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends BaseModel
{
    use SoftDeletes, Imageable, Taggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bonuses';

  
    

    
}
