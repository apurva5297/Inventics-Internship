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

Route::get('/', function () {
   //
    return redirect()->route('Food');
});

Route::get('Food/','foodcontroller@index')->name('Food');


Route::get('Product/','ProductController@index')->name('Product');
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


Route::get('/home', 'foodcontroller@index')->name('home');

Route::get('Typography/','TypographyController@index')->name('Typography');









