<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function index(){

    }

    #region gallery
    //--------------------------------gallary things---

    public function galleryindex()
    {
        //containing all the categories
        $custom_categories=$this->getsubgroupcategories(100);
        return view('Gallery.index',compact('custom_categories'));
    }

    public function gallerycategoies(Request $request)
    {
        $categories=$this->getsubgroupcategories();

        $custom_categories=array();
        foreach($categories as $subgroup)
        {
            //filter searched categories
            if($subgroup->cat_sub_name==$request->subgroup)
            {
                array_push($custom_categories,$subgroup);
            }
        }

        return view('Gallery.custom_categories',compact('custom_categories'));
    }

    #endregion
}
