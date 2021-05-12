<?php
// Route for storefront
Route::group(['middleware' => ['storefront'], 'namespace' => 'Storefront'], function(){
	Route::post('newsletter', 'NewsletterController@subscribe')->name('newsletter.subscribe');

   // Auth route for customers
	include('storefront/Auth.php');
	include('storefront/Cart.php');
	include('storefront/Order.php');
	include('storefront/GiftCard.php');

	Route::middleware(['auth:customer'])->group(function () {
		include('storefront/Account.php');
		include('storefront/Feedback.php');
	});
	Route::get('/landing_old', 'LandingPageController@landing_old')->name('landing_old');
	Route::get('/landing_all-blog', 'LandingPageController@landing_Blogs')->name('landing_allblogs');
	Route::get('/landing_price-list', 'LandingPageController@landing_Pricing')->name('landing_Pricing');
	Route::get('/landing_contact-us', 'LandingPageController@landing_ContactUs')->name('landing_ContactUs');
	Route::get('/landing_faqs', 'LandingPageController@landing_Faqs')->name('landing_Faqs');
	Route::get('/landing_manage', 'LandingPageController@landing_Manage')->name('landing_Manage');
	Route::get('/landing_market', 'LandingPageController@landing_Market')->name('landing_Market');
	Route::get('/landing_about', 'LandingPageController@landing_About')->name('landing_About');
	Route::get('/landing_sell-your-business', 'LandingPageController@landing_SellYourBusiness')->name('landing_SellYourBusiness');
	Route::get('/landing_sell', 'LandingPageController@landing_sell')->name('landing_sell');
	Route::get('/landing_career', 'LandingPageController@landing_career')->name('landing_career');


	Route::get('/', 'LandingPageController@index')->name('homepage');
	Route::get('/all-blog', 'LandingPageController@Blogs')->name('allblogs');
	Route::get('/price-list', 'LandingPageController@Pricing')->name('Pricing');
	Route::get('/contact-us', 'LandingPageController@ContactUs')->name('ContactUs');
	Route::get('/faqs', 'LandingPageController@Faqs')->name('Faqs');
	Route::get('/manage', 'LandingPageController@Manage')->name('Manage');
	Route::get('/market', 'LandingPageController@Market')->name('Market');
	Route::get('/about', 'LandingPageController@About')->name('About');
	Route::get('/sell-your-business', 'LandingPageController@SellYourBusiness')->name('SellYourBusiness');
	Route::get('/sell', 'LandingPageController@sell')->name('sell');
	Route::get('/career', 'LandingPageController@career')->name('career');
	Route::get('/demo-contact', 'LandingPageController@DemoContact')->name('DemoContact');
	Route::post('/schedule-demo', 'LandingPageController@scheduleDemo')->name('scheduleDemo');
	Route::post('/banner_email_form', 'LandingPageController@bannerEmailForm')->name('bannerEmailForm');

	Route::get('/multichannel-solution', 'LandingPageController@multichennelSolution')->name('AbmultichennelSolutionout');
	Route::get('/warehouse-management', 'LandingPageController@warehouseManagement')->name('warehouseManagement');
	Route::get('/ominchannel-solution', 'LandingPageController@omnichannelSolution')->name('omnichannelSolution');
	Route::get('/drop-shipment-solution', 'LandingPageController@dropShipmentSolution')->name('dropShipmentSolution');
	Route::get('/erp-integration', 'LandingPageController@erpIntegration')->name('erpIntegration');
	//Route::get('/', 'HomeController@index')->name('homepage');
	Route::get('page/{page}', 'HomeController@openPage')->name('page.open');
	Route::get('product/{slug}', 'HomeController@product')->name('show.product');
	Route::get('simple_product/{slug}', 'HomeController@simple_product')->name('show.simple_product');
	Route::get('product/{slug}/quickView', 'HomeController@quickViewItem')->name('quickView.product')->middleware('ajax');
	Route::get('product/{slug}/offers', 'HomeController@offers')->name('show.offers');
	Route::get('categories', 'HomeController@categories')->name('categories');
	Route::get('category/{slug}', 'HomeController@browseCategory')->name('category.browse');
	Route::get('categories/{slug}', 'HomeController@browseCategorySubGrp')->name('categories.browse');
	Route::get('categorygrp/{slug}', 'HomeController@browseCategoryGroup')->name('categoryGrp.browse');
	Route::get('shop/{slug}', 'HomeController@shop')->name('show.store');
	// Route::get('shop/reviews/{slug}', 'HomeController@shopReviews')->name('reviews.store');
	Route::get('brand/{slug}', 'HomeController@brand')->name('show.brand');
	Route::get('locale/{locale?}', 'HomeController@changeLanguage')->name('locale.change');
	Route::get('search', 'SearchController@search')->name('inCategoriesSearch');
});

// Route for merchant landing theme
Route::group(['middleware' => ['selling'], 'namespace' => 'Selling'], function(){
	Route::get('selling', 'SellingController@index')->name('selling');
});

// // Route for customers
// Route::group(['as' => 'customer.', 'prefix' => 'customer'], function() {
// 	// include('storefront/Auth.php');
// });
