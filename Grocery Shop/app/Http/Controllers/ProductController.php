<?php

namespace App\Http\Controllers;
use DB;
use App\Inventory;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($cat_group,$cat_name,$slug){

//        dd("heelo world");

        //$my_category='Electronics';
        $img_url="http://zcommerce.online/image/";
        $current_currency="Rs.";
        $feedback=$this->getfeedback();

        $categories=$this->getsubgroup();

        //$books=DB::table('category_sub_groups')->paginate(10);
        $sub_categories=$this->getsubgroupcategories();


        $cat_product=$this->getcategoriesproduct();
        $product=array();
        foreach($cat_product as $cat)
        {
            if($cat->slug==$slug)
            {
                $product=$cat;
            }
        }

        $product_images=$product->img_path;

        $current_subgroup=DB::table('category_sub_groups')
            ->where('slug',$cat_group)->first();
        $current_category=DB::table('categories')
            ->where('slug',$cat_name)->first();

        return view('Product',compact('categories','sub_categories','cat_product','img_url','current_currency','current_subgroup','current_category','product_images','product','feedback'));
        //return view('Food');




        //return view('Product');
    }

    public function productindexwithSlug($slug)
    {
        $cat_product=$this->getcategoriesproduct();
        $product=array();
        foreach($cat_product as $cat)
        {
            if($cat->slug==$slug)
            {
                $product=$cat;
            }
        }

        $product_images=$product->img_path;
        $cat_group=0;
        $cat_name=0;

        foreach($cat_product as $item)
        {
            if($item->slug==$slug)
            {
                $cat_group=$item->product_sub_cat;
                $cat_name=$item->product_cat;
                break;
            }
        }

        $current_subgroup=DB::table('category_sub_groups')
            ->where('slug',$cat_group)->first();
        $current_category=DB::table('categories')
            ->where('slug',$cat_name)->first();

        // $tempProduct=true;
        return view('Product.index',compact('product','product_images','current_subgroup','current_category'));
    }


    public function index1(){
        return view('Layout.ProductPage.ProductPage1');
    }

    public function index2(){
        return view('Layout.ProductPage.ProductPage2');
    }

    public function index3(){
        return view('Layout.ProductPage.ProductPage3');
    }

    public function index4(){
        return view('Layout.ProductPage.ProductPage4');
    }

    public function index5(){
        return view('Layout.ProductPage.ProductPage5');
    }

    public function index6(){
        return view('Layout.ProductPage.ProductPage6');
    }

    public function index7(){
        return view('Layout.ProductPage.ProductPage7');
    }
}
