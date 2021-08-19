<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        return view('Layout.AboutUs.AboutUs');
        //return db::table('addresses')->get();
    }
}
