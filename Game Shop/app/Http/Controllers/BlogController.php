<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
      return view('Blog.BlogList.index');
    }
    public function blogcategory_index()
    {
        return view('Blog.BlogCategory.index');
    }
    public function blogpost_index()
    {
        return view('Blog.BlogPost.index');
    }
}

