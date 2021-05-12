<?php
Route::delete('master-category/{category}/trash', 'MasterCategoryController@trash')->name('mastercategory.trash'); // category post move to trash

Route::get('master-category/{category}/restore', 'MasterCategoryController@restore')->name('mastercategory.restore');

Route::get('master-category','MasterCategoryController@index');
Route::get('master-category/create','MasterCategoryController@create')->name('mastercategory.create');
Route::post('master-category/store','MasterCategoryController@store')->name('mastercategory.store');
Route::get('master-category/{category}/edit','MasterCategoryController@edit')->name('mastercategory.edit');
Route::post('master-category/{category}/update','MasterCategoryController@update')->name('mastercategory.update');

//Route::resource('master-category', 'MasterCategoryController', ['except' => ['show']]);
