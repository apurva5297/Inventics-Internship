<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Repositories\Category\CategoryRepository;
use DB;
use App\Master_cat;
use App\CategoryGroup;
use App\Repositories\CategoryGroup\CategoryGroupRepository;
use App\CategorySubGroup;
use App\Repositories\CategorySubGroup\CategorySubGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class CategoryController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function __construct(CategoryGroupRepository $categoryGroup, CategorySubGroupRepository $categorySubGroup,CategoryRepository $category)
    {
        $this->categoryGroup = $categoryGroup;
        $this->categorySubGroup = $categorySubGroup;
        $this->category = $category;
    }

    public function masterCategoryList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = Master_cat::get();
            return $this->processResponse('master_category_list',$data,'success','List of Master Category');
        }   
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function CategoryGroupList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            $category_groups = $this->categoryGroup->CategoryGroup($request);
            foreach($category_groups as $category_group)
            {
                $data[] = array(
                    'id' => $category_group->id,
                    'name' => $category_group->name,
                    'master_category_id' => $category_group->master_cat_id,
                    'sub_groups_count' => $category_group->sub_groups_count,
                    'image' => $category_group->image->path
                );
            }
            return $this->processResponse('category_group_list',$data,'success','List of Category Group');
        }   
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function CategorySubGroupList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            $category_sub_groups = $this->categorySubGroup->CategorySubGroup($request);
            foreach($category_sub_groups as $category_sub_group)
            {
                $data[] = array(
                    'id' => $category_sub_group->id,
                    'name' => $category_sub_group->name,
                    'category_group_id' => $category_sub_group->category_group_id,
                    'categories_count' => $category_sub_group->categories_count,
                    'image' => $category_sub_group->image
                );
            }
            return $this->processResponse('sub_category_list',$data,'success','List of Sub Category');
        }   
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function CategoryList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            $categories = $this->category->Category($request);
            foreach($categories as $category)
            {
                $data[] = array(
                    'id' => $category->id,
                    'name' => $category->name,
                    'category_sub_group_id' => $category->category_sub_group_id,
                    'products_count' => $category->products_count,
                    'listing_count' => $category->listings_count,
                    'image' => $category->featuredImage->path
                );
            }
            return $this->processResponse('category_list',$data,'success','List of Category');
        }   
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

}
