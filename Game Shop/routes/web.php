<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('Game');
});
Route::get("game","GameController@index")->name("Game");
Route::get("product","ProductController@index")->name("Product.index");
Route::get('account','AccountController@index')->name('accountdetails.index');
Route::get('wishlist','AccountController@accountwishlist_index')->name('accountwishlist.index');