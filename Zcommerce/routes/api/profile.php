<?php
Route::post('/country_list','Api\ProfileController@countryList');
Route::post('/state_list','Api\ProfileController@stateList');
Route::post('/shop_address_create','Api\ProfileController@shopAddressCreate');

Route::post('/shop_profile_update','Api\ProfileController@shopProfile');

Route::post('/shop_qr_code','Api\ProfileController@shopQRCode');
Route::post('/shop_qr_code_view','Api\ProfileController@shopQRCodeView');

Route::post('/order_handling_cost','Api\ProfileController@orderHandlingCost');
Route::post('/order_handling_cost_update','Api\ProfileController@orderHandlingCostUpdate');

Route::post('/shop_logo','Api\ProfileController@shopLogo');
Route::post('/shop_logo_update','Api\ProfileController@shopLogoUpdate');
// Route::post('/shop_banner','Api\ProfileController@shopBannnr');
// Route::post('/shop_banner_update','Api\ProfileController@shopBannerUpdate');

Route::post('/measuring_units','Api\ProfileController@MeasurngUnits');
?>