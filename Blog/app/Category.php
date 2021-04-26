<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits;
class Category extends Model
{
    use Traits\SearchTrait;
    use SoftDeletes;
    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
}
