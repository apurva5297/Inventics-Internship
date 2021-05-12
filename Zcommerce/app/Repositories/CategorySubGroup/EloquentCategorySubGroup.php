<?php

namespace App\Repositories\CategorySubGroup;

use App\CategorySubGroup;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCategorySubGroup extends EloquentRepository implements BaseRepository, CategorySubGroupRepository
{
	protected $model;

	public function __construct(CategorySubGroup $categorySubGroup)
	{
		$this->model = $categorySubGroup;
	}

    public function all()
    {
        return $this->model->with('group:id,name,deleted_at')->withCount('categories')->get();
    }

    public function trashOnly()
    {
        return $this->model->with('group:id,name,deleted_at')->onlyTrashed()->get();
    }

    public function CategorySubGroup(Request $request)
    {
        $category_group_id = $request->category_group_id ? $request->category_group_id : null;
        return $this->model->with('group:id,name,deleted_at')->withCount('categories')
                ->where(function($query) use($category_group_id){
                    if($category_group_id != null)
                        $query->whereIn('category_group_id',json_decode($category_group_id));
                })->get();
    }
}