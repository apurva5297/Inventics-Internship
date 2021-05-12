<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

include('android_api/team/team.php');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
include('api/auth/index.php');
include('api/category.php');
include('api/home.php');
include('api/orders.php');
include('api/products.php');
include('api/inventory.php');
include('api/profile.php');
include('api/manage.php');
include('api/customers.php');
include('api/pages.php');
include('api/banner.php');
include('api/bank_details.php');
include('api/payment.php');

Route::post('/check_version/{version}', 'Api\Buyerapi@check_version');
Route::post('/feed_banner', 'Api\Buyerapi@feed_banner');
Route::post('banner', 'Api\HomeController@sliders'); //sliders
//Route::get('banners', 'Api\HomeController@banners');

Route::post('subcategory', 'Api\CategoryController@categorySubGroup');  //category-subgrps
Route::post('subcategory-grps/{id}', 'Api\CategoryController@index'); //categories

Route::post('category', 'Api\CategoryController@categorySubGroup');
//Route::post('category', 'Api\CategoryController@categoryGroup'); //category-grps
Route::post('products_by_category/{id}/{page_id}', 'Api\ListingController@browseCategory'); //slug  //browseCategoryGroup

Route::post('subcategory/{id}', 'Api\CategoryController@index');

Route::post('/products_by_subcategory/{id}/{page_id}', 'Api\ListingController@products_by_subcategory');

Route::post('/new_products', 'Api\ListingController@index');

Route::post('featured_products', 'Api\ListingController@featured_products');  //(listings)trending,popular,random,latest
Route::post('/featured_category/{page_id}', 'Api\ListingController@featured_category');

Route::post('/featured_brand/{page_id}', 'Api\ListingController@featured_brand');

Route::post('product/{id}', 'Api\ListingController@item');
Route::post('shipping_details', 'Api\ListingController@shipping_details');
Route::post('details_by_id/{id}', 'Api\ListingController@details_by_id');

Route::post('product_description/{id}', 'Api\ListingController@getDescription');



/*Route::post('login', 'Storefront\Auth\LoginController@login');
Route::post('logout', 'Storefront\Auth\LoginController@logout');
Route::post('register', 'Storefront\Auth\RegisterController@register');*/



Route::post('/request_login_otp/{phone}', 'Api\Buyerapi@request_login_otp');
Route::post('/customer_login', 'Api\Buyerapi@customer_login');
//Route::post('/logout', 'Api\Buyerapi@logout');

Route::post('/request_signup_otp/{phone}', 'Api\Buyerapi@request_signup_otp');
Route::post('/verify_otp/{phone}/{otp}', 'Api\Buyerapi@verify_otp');

Route::post('/verify_login_otp/{phone}/{otp}', 'Api\Buyerapi@verify_login_otp');

Route::post('/wallet_balance', 'Api\Buyerapi@wallet_balance');
Route::post('/recent_transactions', 'Api\Buyerapi@recent_transactions');
Route::post('/wallet_banner', 'Api\Buyerapi@wallet_banner');

Route::post('/all_address', 'Api\Buyerapi@all_address');
Route::post('/add_address', 'Api\Buyerapi@add_address');
Route::post('/update_address/{address_id}', 'Api\Buyerapi@update_address');
Route::post('/delete_address/{address_id}', 'Api\Buyerapi@delete_address');


Route::post('/order_place', 'Api\ListingController@order_place');
Route::post('/myorders', 'Api\Buyerapi@myorders');
Route::post('/order_details/{order_id}', 'Api\Buyerapi@order_details');

Route::post('/search/{page_id}', 'Api\Buyerapi@search');
///seller Mobile Application

Route::post('/product_image', 'Api\Sellerapi@upload_image');
Route::post('/product_upload', 'Api\Sellerapi@import');
Route::post('/product_list/{shop_id}', 'Api\Sellerapi@product_list');
Route::post('/update_product/{id}', 'Api\Sellerapi@update_product');
Route::post('/product_delete/{id}', 'Api\Sellerapi@product_delete');

Route::post('/change_price_list', 'Api\Sellerapi@product_price_list');
Route::post('/price_update/{id}', 'Api\Sellerapi@product_price_update');

Route::post('/seller_profile_details/{id}', 'Api\Sellerapi@seller_profile_detail');
Route::post('/seller_doc_upload', 'Api\Sellerapi@client_doc_upload');
Route::post('/seller_profile_upadate/{id}', 'Api\Sellerapi@profile_update');

Route::post('/orderList', 'Api\Sellerapi@order_list');
Route::post('/seller_order_details/{order_id}', 'Api\Sellerapi@seller_order_details');
Route::post('/order_status_update/{order_id}', 'Api\Sellerapi@order_status_update');

Route::post('/agent_profile_details/{id}', 'Api\Sellerapi@agent_profile_details');
Route::post('/agent_doc_upload', 'Api\Sellerapi@agent_doc_upload');
Route::post('/agent_profile_upadate/{id}', 'Api\Sellerapi@agent_profile_update');

Route::post('/buyerList', 'Api\Sellerapi@agent_buyerList');
Route::post('/order_list', 'Api\Buyerapi@myorders');
// all category
Route::post('/supercategory', 'Api\Buyerapi@supercategory');
Route::post('/categoryList', 'Api\Buyerapi@categoryList');
Route::post('/sub_category', 'Api\Buyerapi@Sub_CategoryList');

Route::post('/today_total_sale', 'Api\Sellerapi@today_sale_count');
Route::post('/visitor_chart', 'Api\Sellerapi@visitorsOfMonths');
Route::post('/visitor_count', 'Api\Sellerapi@product_visit_count');

Route::post('/getfbpost', 'Api\Facebook@getPost');
Route::post('/extract', 'Api\Facebook@extract');
Route::post('/import', 'Api\Facebook@import');
Route::post('/mapping', 'Api\Facebook@mapping');


