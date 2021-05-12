<?php
	Route::post('/orders','Api\OrderController@orders'); 
	Route::post('/order_detail','Api\OrderController@orderDetail'); 
	Route::post('order_status_list','Api\OrderController@orderStatusList');
	Route::post('order_status_update','Api\OrderController@orderStatusUpdate');

	Route::post('returns','Api\OrderController@returns');
	Route::post('return_detail','Api\OrderController@returnDetail');
	Route::post('return_status_list','Api\OrderController@returnStatusList');
	Route::post('return_status_update','Api\OrderController@returnStatusUpdate');

	Route::post('payment_status_update','Api\OrderController@paymentStatus');

	Route::post('pdf_save','Api\OrderController@pdfSave');

	Route::post('generate_bill','Api\OrderController@generateBill');
?>