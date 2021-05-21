<?php
Route::resource('wallets', 'WalletController');
Route::get('withdraw/test', 'WalletController@approved')->name('test');
Route::get('withdraw/test_delete', 'WalletController@decline')->name('test_delete');
Route::get('withdraw', 'WalletController@withdraw')->name('withdraw.index');
Route::get('bank_details/{id}', 'WalletController@bank_details')->name('bank_details');
Route::get('wallets/list/{id}','WalletController@transaction_list')->name('wallets.list');
