<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
//    public $my_category='Apparel';
//    public $store_type='Fashion';
    public function index()
    {
        $img_url="http://zcommerce.online/image/";

        $current_currency="Rs.";
        $announcement=$this->announcements();

        $categories=$this->getsubgroup();


        $sub_categories=$this->getsubgroupcategories();


        $cat_product=$this->getcategoriesproduct();
    
        $banners=$this->banner();
//dd($banners);
        $x=DB::table('inventories')->get();
    

        $blogs=$this->blog();

        $slider= $this->slider();
       // dd($slider);
  
        return view('Food',compact('categories','sub_categories','cat_product','img_url','slider','current_currency','banners','blogs','announcement'));
        //return view('Food');

    }
}
