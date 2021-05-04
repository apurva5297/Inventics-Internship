<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
  return view('Account.account-details');
    }
    public function accountwishlist_index()
    {
  return view('Account.account-wishlist');
    }
    public function accountaddress_index()
    {
  return view('Account.account-address');
    }
    public function accountorderhistory_index()
    {
  return view('Account.account-orderhistory');
    }
 

}

