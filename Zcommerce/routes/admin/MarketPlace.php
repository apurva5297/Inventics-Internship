<?php
	// // Bulk upload routes
	// Route::get('customer/upload/downloadTemplate', 'CustomerUploadController@downloadTemplate')->name('customer.downloadTemplate');
	// Route::get('customer/upload', 'CustomerUploadController@showForm')->name('customer.bulk');
	// Route::post('customer/upload', 'CustomerUploadController@upload')->name('customer.upload');
	// Route::post('customer/import', 'CustomerUploadController@import')->name('customer.import');
	// Route::post('customer/downloadFailedRows', 'CustomerUploadController@downloadFailedRows')->name('customer.downloadFailedRows');
	Route::get('marketplace-module-mapping', 'MarketPlaceController@MarketplaceModule');

	Route::get('marketplace-module-mapping/create', 'MarketPlaceController@MarketplaceModuleCreate');

	Route::get('marketplace-module-mapping/module_field/{id}', 'MarketPlaceController@MarketplaceModuleField');

	Route::post('marketplace-module-mapping-store', 'MarketPlaceController@MarketplaceModuleStore');

	Route::get('marketplace-module-mapping/edit/{id}', 'MarketPlaceController@MarketplaceModuleEdit');

	Route::post('marketplace-module-mapping/update/{id}', 'MarketPlaceController@MarketplaceModuleUpdate');

	// Customer Routes
	Route::resource('marketplace', 'MarketPlaceController');

	// Route::get('customer/{customer}/profile', 'CustomerController@profile')->name('customer.profile');
	// Route::get('customer/{customer}/addresses', 'CustomerController@addresses')->name('customer.addresses');
	// Route::delete('customer/{customer}/trash', 'CustomerController@trash')->name('customer.trash');
	// Route::get('customer/{customer}/restore', 'CustomerController@restore')->name('customer.restore');
	// Route::get('customer/getCustomers', 'CustomerController@getCustomers')->name('customer.getMore')->middleware('ajax');

	// Route::post('customer/{customer}/custcredit', 'CustomerController@custcredit')->name('customer.custcredit');

	// Route::post('customer/current_balance', 'CustomerController@current_balance');
	
