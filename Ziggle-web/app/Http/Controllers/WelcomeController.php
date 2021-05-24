<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
   
    public function index()
    {
        return view('welcome.index');
    }
    public function about()
    {
        return view('welcome.about');
    }
    public function blog()
    {
        return view('welcome.blog');
    }
    public function contact()
    {
        return view('welcome.contact');
    }
}