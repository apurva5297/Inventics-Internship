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
use App\Http\Controllers\FoodController;

include('authroute.php');
include('searchroute.php');

Route::get('/','FoodController@index')->name('Food');


Route::get('product/{catgroup}/{catname}/{slug}','ProductController@index')->name('Product');
Route::get('Product1/','ProductController@index1')->name('Product1');
Route::get('Product2/','ProductController@index2')->name('Product2');
Route::get('Product3/','ProductController@index3')->name('Product3');
Route::get('Product4/','ProductController@index4')->name('Product4');
Route::get('Product5/','ProductController@index5')->name('Product5');
Route::get('Product6/','ProductController@index6')->name('Product6');
Route::get('Product7/','ProductController@index7')->name('Product7');


Route::get('Account/','AccountController@index')->name('Account');
Route::get('AccountCreate/','AccountController@index1')->name('AccountCreate');
Route::get('AccountDetails/','AccountController@index2')->name('AccountDetails');
Route::get('AccountHistory/','AccountController@index3')->name('AccountHistory');
Route::get('AccountWishlist/','AccountController@index4')->name('AccountWishlist');
Route::get('AccountAddress/','AccountController@index5')->name('AccountAddress');
Route::get('AccountLogin/','Accountcontroller@index6')->name('AccountLogin');

include('checkoutroute.php');

Route::get('Cart/','CartController@index')->name('Cart');
Route::get('CartStyle2/','CartController@index1')->name('CartStyle2');
Route::get('CartEmpty/','CartController@index2')->name('CartEmpty');


Route::get('Blog/','BlogController@index')->name('Blog');
Route::get('BlogGrid/','BlogController@index1')->name('BlogGrid');
Route::get('BlogLeftSidebar/','BlogController@index2')->name('BlogLeftSidebar');
Route::get('BlogStickySidebar/','BlogController@index3')->name('BlogStickySidebar');
Route::get('BlogWithoutSidebar/','BlogController@index4')->name('BlogWithoutSidebar');
Route::get('BlogPost/','BlogController@index5')->name('BlogPost');


Route::get('Checkout/','CheckoutController@index')->name('Checkout');
Route::get('Checkout2/','CheckoutController@index1')->name('Checkout2');
Route::get('Checkout3/','CheckoutController@index2')->name('Checkout3');


Route::get('Category/','CategoryController@index')->name('Category');
Route::get('CategoryClosedFilter/','CategoryController@index1')->name('CategoryClosedFilter');
Route::get('CategoryEmpty/','CategoryController@index2')->name('CategoryEmpty');
Route::get('CategoryHorizontalFilter/','CategoryController@index3')->name('CategoryHorizontalFilter');
Route::get('CategoryListView/','CategoryController@index4')->name('CategoryListView');
Route::get('CategoryPagination/','CategoryController@index5')->name('CategoryPagination');


Route::get('Collections/','CollectionsController@index')->name('Collections');

Route::get('ComingSoon/','ComingSoonController@index')->name('ComingSoon');


Route::get('ContactUs/','ContactUsController@index')->name('ContactUs');


Route::get('Faq/','FaqController@index')->name('Faq');


Route::get('Gallery/','GalleryController@index')->name('Gallery');


Route::get('PageNotFound/','PageNotFoundController@index')->name('PageNotFound');

Route::get('AboutUs/','AboutUsController@index')->name('AboutUs');


Route::get('home/','HomeController@index')->name('Home');

Route::get('Typography/','TypographyController@index')->name('Typography');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('addcartpage/','Cartcontroller@add_to_cart')->name('addtocart');




Route::post('add_to_cart','CartController@addToCart')->name('addtocart');
Route::post('update_to_cart','CartController@update_to_cart')->name('update_to_cart');
Route::post('delete_product_from_cart','CartController@delete_product_from_cart')->name('delete_product_from_cart');


//minicart routes
Route::post('getMiniCartItemdata','CartController@getMiniCartItemdata')->name('getMiniCartItemdata');
Route::post('getTotalCartItems','CartController@getTotalCartItems')->name('getTotalCartItems');
Route::post('deleteMinicartItemData','CartController@deleteMinicartItemData')->name('deleteMinicartItemData');

Route::post('testFunction','CartController@testFunction')->name('testFunction');

Route::get('product_this/{slug}','ProductController@productindexwithSlug')->name('ProductCurrent');

Route::get('Error','OtherController@index')->name('Error');

Route::get('gallery','OtherController@galleryindex')->name('Gallery');
Route::post('gallery_categories','OtherController@gallerycategoies')->name('gallerycategoies');

Route::get('/sendotp', 'Auth\LoginController@sendOTP')->name('otp');
Route::post('/verifyotp', 'Auth\LoginController@verifyOTP')->name('verifyotp');



Route::post('place_order','Ordercontroller@place_order')->name('place_order');
Route::get('clearhistory','Ordercontroller@clear_orderhistory')->name('clear_history');
Route::post('order_cancel','Ordercontroller@cancel_order')->name('cancel_order');
Route::get('reorder/{order_id}','Ordercontroller@Reorder')->name('reorder');
Route::post('oder-history','AccountController@orderList')->name('order-history');



