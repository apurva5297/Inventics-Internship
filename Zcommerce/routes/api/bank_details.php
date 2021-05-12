<?php
Route::post('/bank_list','Api\BankDetailController@bank_list');

Route::post('/bank_detail','Api\BankDetailController@index');
Route::post('/bank_detail_store','Api\BankDetailController@store');
Route::post('/bank_detail_view','Api\BankDetailController@view');
Route::post('/bank_detail_update','Api\BankDetailController@update');
?>