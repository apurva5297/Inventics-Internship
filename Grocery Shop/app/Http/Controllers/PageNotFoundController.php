<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageNotFoundController extends Controller
{
    public function index(){
        return view('Layout.PageNotFound.PageNotFound');
    }
}
