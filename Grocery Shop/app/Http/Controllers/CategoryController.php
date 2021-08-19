<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{


        public function index($slug){
            $img_url=$this->server_image_path;
            $currency=$this->currency;
            $categories=$this->getsubgroup();
            $sub_categories=$this->getsubgroupcategories();
            //getting with images
            $cat_product=$this->getcategoriesproduct("latest");


            $allBrands=array();

            foreach($cat_product as $product)
            {

                $flag=0;
                foreach($allBrands as $br)
                {
                    if($product->brand==$br)
                    {
                        $flag=1;
                        break;
                    }
                }
                if($flag==0)
                {
                    array_push($allBrands,$product->brand);
                }
            }

            //dd($allBrands);

            $tempcategory=true;
            return view('Layout.Category.Category',compact('tempcategory','categories','sub_categories','cat_product','img_url','currency','slug','allBrands'));
        }









        //return view('Layout.Category.Category');




    public function index1(){
        return view('Layout.Category.CategoryClosedFilter');
    }

    public function index2(){
        return view('Layout.Category.CategoryEmpty');
    }

    public function index3(){
        return view('Layout.Category.CategoryHorizontalFilter');
    }

    public function index4(){
        return view('Layout.Category.CategoryListView');
    }

    public function index5(){
        return view('Layout.Category.CategoryPagination');
    }
}
