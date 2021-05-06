<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
      return view('Cart.CartPage.index');
    }
    public function checkout_index()
    {
      return view('Cart.Checkout.index');
    }
    public function emptycart_index()
    {
      return view('Cart.EmptyCart.index');
    }
}
