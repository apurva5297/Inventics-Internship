<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Master_cat extends Model
{
    use SoftDeletes;
    
	protected $table = 'master_categories';

	protected $fillable = ['name','image', 'status'];
	
	public function CategoryGroup()
	{
		return $this->hasMany(CategoryGroup::class);
	}

}
