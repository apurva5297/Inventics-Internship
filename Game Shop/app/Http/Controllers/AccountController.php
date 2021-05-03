<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index($page)
    {
  
      return view('Account.index',compact('page'));
    }
    public function account_details()
    {
      return view('Account.account-details');
    }
}

