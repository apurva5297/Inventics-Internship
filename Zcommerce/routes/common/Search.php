<?php
Route::get('search/customer', 'SearchController@findCustomer')->name('search.customer')->middleware('ajax');

Route::get('search/product', 'SearchController@findProduct')->name('search.product')->middleware('ajax');
/*bin*/
Route::get('search/inventory', 'SearchController@findInventory')->name('search.inventory')->middleware('ajax');

Route::get('search/add-to-bin', 'SearchController@addToBin')->name('search.add-to-bin')->middleware('ajax');


Route::get('message/search', 'SearchController@findMessage')->name('message.search');
