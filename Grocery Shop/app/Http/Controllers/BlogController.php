<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{


        public function index()
        {
            $img_url=$this->server_image_path;
            $categories=$this->getsubgroup();
            $sub_categories=$this->getsubgroupcategories();
            //    dd($sub_categories);
            $cat_product=$this->getcategoriesproduct();
            $blog_category=$this->blogcategory();
           // dd($blog_category);

        return view('Layout.Blog.Blog',compact('img_url','categories','sub_categories','cat_product','blog_category'));
       // return view('Layout.Blog.Blog');
    }

    public function index1(){
        return view('Layout.Blog.BlogGrid');
    }

    public function index2(){
        return view('Layout.Blog.BlogLeftSidebar');
    }

    public function index3(){
        return view('Layout.Blog.BlogStickySidebar');
    }
    public function index4(){
        return view('Layout.Blog.BlogWithoutSidebar');
    }
    public function index5(){
        return view('Layout.Blog.BlogPost');
    }
}
