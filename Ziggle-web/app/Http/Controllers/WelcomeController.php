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
    public function privacy()
    {
        return view('welcome.privacy');
    }
    public function terms()
    {
        return view('welcome.terms');
    }
}