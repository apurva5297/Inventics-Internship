<?php
Route::post('/available_payment_method','Api\ProfileController@availablePaymentMethod');

Route::post('/show_paytm_detail','Api\PaymentController@showPaytmDetail');

Route::post('/update_paytm_detail','Api\PaymentController@updatePaytmDetail');

Route::post('/deactivate-paytm','Api\PaymentController@decativatePaytm');
?>