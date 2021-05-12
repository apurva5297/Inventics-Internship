<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoryGroup;
use App\CategorySubGroup;

class AjaxController extends Controller
{
    /**
     * [ajaxGetFromPHPHelper description]
     *
     * @param  str $funcName name of the PHP helper fucntion
     * @param  mix $args     arguments will need to pass to the helper function
     *
     * @return mix         results from PHP Helper fucntion
     */
    public function ajaxGetFromPHPHelper(Request $request)
    {
        // \Log::info($request->all());

        if ($request->ajax()) {
            $funcName = $request->input('funcName');
            $args = $request->input('args');

            $args = is_array($args) ? $args : explode(',', $args);

            $results = call_user_func_array($funcName, $args);

            if(is_object($results))
                return json_encode($results);

            return $results;
        }

        return false;
    }

    /**
     * Return Shipping Options
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function filterShippingOptions(Request $request)
    {
        if ($request->ajax()){
            return filterShippingOptions($request->input('zone'), $request->input('price'), $request->input('weight'));
        }

        return false;
    }

    public function ajaxGetCategoryGroup($master_cate_id)
    {
        $category_groups = CategoryGroup::where('master_cat_id',$master_cate_id)->get();
        $data = '<option value="">Select Category Group</option>';
        foreach($category_groups as $category_group)
        {
            $data = $data.'<option value="'.$category_group->id.'">'.$category_group->name.'</option>';
        }
        return $data;
    }

    public function ajaxGetSubCategory(Request $request)
    {
        $category_group_id = $request->category_group_id;
        $category_groups = CategorySubGroup::where('category_group_id',$category_group_id)->get();
        $data = '<option value="">Select Sub Category</option>';
        foreach($category_groups as $category_group)
        {
            $data = $data.'<option value="'.$category_group->id.'">'.$category_group->name.'</option>';
        }
        return $data;
    }
}
