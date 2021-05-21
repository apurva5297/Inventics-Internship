<?php
Route::get('catalogs/products/{id}', 'CatalogsController@products')->name('catalogs.products');
Route::get('test', 'CatalogsController@products_store')->name('test');
Route::get('test_delete', 'CatalogsController@delete_products')->name('test_delete');
Route::get('catalogs/products/add/{id}', 'CatalogsController@add_products')->name('catalogs.products.add');
Route::resource('catalogs', 'CatalogsController', ['except' => ['show']]);
Route::post('catalogs/products/create','CatalogsController@create_catalogs')->name('catalogs.products.create');
Route::get('catalogs/index','CatalogsController@getProducts')->name('catalogs.index');