<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits;
class Blog extends Model
{
    use Traits\SearchTrait;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
