<?php

//test routes
Route::get('check_out/{cart_no}','CheckOutController@index')->name('CheckOut');
Route::post('saveShippingIdForCheckout','CheckoutController@saveShippingIdForCheckOut')->name('saveShippingIdForCheckOut');
Route::post('saveBillingIdForCheckout','CheckoutController@saveBillingIdForCheckOut')->name('saveBillingIdForCheckOut');
Route::post('placeOrder','CheckoutController@placeOrder')->name('placeOrder');
Route::get('clearorderhistory','CheckOutController@clearorderhistory')->name('clearorderhistory');
Route::get('reorderMyOrder/{order_id}','CheckOutController@reorderMyOrder')->name('reorderMyOrder');
Route::post('cancelMyOrder','CheckOutController@cancelMyOrder')->name('cancelMyOrder');
