<?php

// use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function(){
	Route::post('home', 'HomeController@home');
	Route::post('products', 'HomeController@products');
	Route::post('catalog_products', 'HomeController@catalog_products');

	Route::post('category_products/{id}', 'ListingController@category_products');
	Route::post('product_inventories/{id}', 'HomeController@product_inventories');
	Route::post('banners', 'HomeController@banners');
	Route::post('category-grps', 'CategoryController@categoryGroup');
	Route::post('category-subgrps/{group?}', 'CategoryController@categorySubGroup');
	Route::post('categories/{sub_group?}', 'CategoryController@index');
	Route::post('categories_category/{sub_group?}', 'CategoryController@categories');
	Route::post('countries', 'HomeController@countries');
	Route::post('states/{country}', 'HomeController@states');
	Route::post('city/{state}', 'HomeController@city');

	Route::get('blogs', 'BlogController@index');
	Route::post('blog/{slug}', 'BlogController@show');

	Route::post('page/{slug}', 'HomeController@page');
	Route::post('shops', 'HomeController@allShops');
	Route::post('shop/{slug}', 'HomeController@shop');
	Route::get('packaging/{shop}', 'HomeController@packaging');
	Route::post('shipping/{shop}', 'HomeController@shipping');
	Route::get('paymentOptions/{shop}', 'HomeController@paymentOptions');
	Route::get('offers/{slug}', 'HomeController@offers');
	Route::get('listings/{list?}', 'ListingController@index');
	Route::post('listing/{slug}', 'ListingController@item');
	Route::post('variant/{slug}', 'ListingController@variant');
	Route::post('variant_size/{slug}', 'ListingController@variant_size');
	Route::post('search/{term}', 'ListingController@search');
	Route::get('shop/{slug}/listings', 'ListingController@shop');
	Route::post('brand/{id}','ListingController@brand');
	Route::post('listing/category/{slug}', 'ListingController@category');
	Route::get('listing/category-subgrp/{slug}', 'ListingController@categorySubGroup');
	Route::get('listing/category-grp/{slug}', 'ListingController@categoryGroup');
	Route::post('listing/{item}/shipTo', 'ListingController@shipTo');
	Route::get('listing/{slug}/feedbacks', 'FeedbackController@show_item_feedbacks');
	Route::get('shop/{slug}/feedbacks', 'FeedbackController@show_shop_feedbacks');
	Route::post('filter_list', 'ListingController@filter_list');
	Route::post('filter_store/{slug}', 'ListingController@filter_store');
	Route::post('bonus_tracker', 'BonusController@bonus_tracker');
	Route::post('bonus_tracker_order', 'BonusController@bonus_tracker_order');
	Route::post('sorting/{slug}', 'ListingController@sorting');
	Route::post('count_cart_items', 'HomeController@count_cart_items');
	Route::post('other', 'HomeController@others');
	Route::post('shared_catalogs', 'HomeController@shared_catalogs');
	Route::post('shared_catalogs_show', 'HomeController@shared_catalogs_show');
	Route::post('check_image_upload', 'ListingController@check_image_upload');
	Route::post('bank_details', 'ListingController@bank_details');
	Route::post('bank_details_show', 'ListingController@bank_details_show');
	Route::post('business_card', 'HomeController@business_card');
	Route::post('profile', 'HomeController@profile');
	Route::post('profile/update', 'HomeController@profile_update');
	Route::post('referals', 'HomeController@referals');
	

	//Wallet 
    Route::post('/wallet-balance','WalletController@wallet_balance');
    Route::post('/wallet-request','WalletController@walletRequest');
    Route::post('/add-balance','WalletController@add_balance');
	Route::post('/wallet-response','WalletController@walletResponse');
    Route::post('/deduct-balance','WalletController@deduct_balance');
    Route::post('/wallet-transaction','WalletController@transaction');
	
	//Order time payment integration
	Route::post('create_transaction', 'TransactionController@create_transaction');
	Route::post('walletResponse', 'TransactionController@walletResponse');

	//Referral Code
	Route::post('/refer-code','ReferralController@referral_code');


	// CART
	Route::post('addToCart/{slug}', 'CartController@addToCart');
	Route::post('cart/removeItem', 'CartController@remove');
	Route::post('cart/{cart}/delete', 'CartController@delete');
	Route::get('carts', 'CartController@index');
	Route::post('cart/show', 'CartController@show');
	Route::post('cart/{cart}/update', 'CartController@update');
	Route::post('cart/{cart}/update_margin', 'CartController@update_margin');
	Route::post('cart/{cart}/shipTo', 'CartController@shipTo');
	Route::post('cart/{cart}/shipping', 'CartController@shipping');
	Route::post('cart/{cart}/checkout', 'CheckoutController@checkout');
	Route::post('order/status/{id}', 'ListingController@order_status');
	Route::post('dispute/status/{id}', 'ListingController@dispute_status');


	// Route::get('cart/{expressId?}', 'CartController@index')->name('cart.index');
	// Route::get('checkout/{slug}', 'CheckoutController@directCheckout');

	Route::group(['prefix' => 'auth'], function(){
		Route::post('get_connection_id', 'AuthController@get_connection_id');
		Route::post('register', 'AuthController@register');
		Route::post('otp_request/{type?}', 'AuthController@otp_request');
		Route::post('login', 'AuthController@login');
		Route::post('logout', 'AuthController@logout');
		Route::post('profile/show', 'AuthController@profile');
		Route::post('profile/update', 'AuthController@profile_update');
		

		//Route::post('forgot', 'AuthController@forgot');
    	//Route::get('reset/{token}', 'AuthController@find');
		//Route::post('reset', 'AuthController@reset');
    	//Route::post('social/{provider}', 'AuthController@socialLogin');
    	// Route::get('social/{provider}', 'AuthController@socialLogin');
    	// Route::get('social/{provider}/callback', 'AuthController@handleSocialProviderCallback');
	});

		Route::post('store_margin', 'AuthController@store_margin');
		Route::post('get_margin', 'AuthController@get_margin');
		Route::post('upload_video', 'AuthController@upload_video');
		Route::post('upload_video/delete', 'AuthController@delete_videos');
		Route::post('listing_videos/show', 'AuthController@listing_videos');
		Route::post('upload_image_profile', 'AuthController@upload_image_profile');

	// Route::group(['middleware' => 'auth:api'], function(){
		Route::get('dashboard', 'AccountController@index');
		Route::get('account/update', 'AccountController@edit');
		Route::put('account/update', 'AccountController@update');
		Route::put('password/update', 'AccountController@password_update');
		Route::get('addresses', 'AddressController@index');
		Route::get('address/create', 'AddressController@create');
		Route::post('address/store', 'AddressController@store');
		Route::get('address/{address}', 'AddressController@edit');
		Route::post('address/{address}/update', 'AddressController@update');
		Route::post('address/{address}/delete', 'AddressController@delete');
		Route::post('address/show', 'AddressController@show');
		Route::get('coupons', 'AccountController@coupons');
		Route::post('cart/{cart}/applyCoupon', 'CartController@validateCoupon');
		Route::post('wishlist', 'WishlistController@index');
		Route::post('wishlist/{slug}/add', 'WishlistController@add');
		Route::post('wishlist/{wishlist}/remove', 'WishlistController@remove');
		Route::post('orders', 'OrderController@index');
		Route::post('order_details/{order}', 'OrderController@show');
		Route::post('cancel_order/{order}', 'OrderController@cancel_order');
		Route::post('order_return/{order}', 'OrderController@order_return');
		Route::post('get_reason_list', 'OrderController@get_reason_list');
		Route::post('get_reviews', 'OrderController@get_reviews');
		Route::get('order/{order}/conversation', 'OrderController@conversation');
		Route::post('order/{order}/conversation', 'OrderController@save_conversation');
		Route::get('order/{order}/track', 'OrderController@track');
		Route::get('conversations', 'ConversationController@conversations');
		Route::get('shop/{shop}/contact', 'ConversationController@conversation');
		Route::post('shop/{shop}/contact', 'ConversationController@save_conversation');
		Route::post('shop/{order}/feedback', 'FeedbackController@save_shop_feedbacks');
		Route::post('order/{order}/feedback', 'FeedbackController@save_product_feedbacks');
		Route::post('order/{order}/goodsReceived', 'OrderController@goods_received');
		Route::post('dispute_types', 'DisputeController@dispute_types');
		Route::post('disputes', 'DisputeController@index');
		Route::get('order/{order}/dispute', 'DisputeController@create');
		Route::post('order/{order}/dispute', 'DisputeController@store');
		Route::post('dispute/{dispute}', 'DisputeController@show');
		Route::get('dispute/{dispute}/response', 'DisputeController@response_form');
		Route::post('dispute/{dispute}/response', 'DisputeController@response');
		Route::post('dispute/{dispute}/appeal', 'DisputeController@appeal');
		Route::put('dispute/{dispute}/solved', 'DisputeController@mark_as_solved');

		Route::get('attachment/{attachment}/download', 'AttachmentController@download');
		Route::post('test', 'ListingController@test');

		//Zoom store api
		Route::post('zoom/store', 'ZoomController@store');
		Route::post('zoom/data', 'ZoomController@index');
		Route::post('zoom/data/delete', 'ZoomController@delete');

	// });
});