<?php
	// warehouses
	Route::delete('warehouse/{warehouse}/trash', 'WarehouseController@trash')->name('warehouse.trash'); // warehouse move to trash 
	
	Route::get('warehouse/{warehouse}/restore', 'WarehouseController@restore')->name('warehouse.restore');
	Route::get('create-zone-group/{warehouse}', 'WarehouseController@IndexZoneGroup')->name('warehouse.create-zone-group');
	Route::post('submit-zone-group', 'WarehouseController@CreateZoneGroup')->name('warehouse.submit-zone-group');

	Route::get('edit-group/{warehouse}', 'WarehouseController@EditZoneGroup')->name('warehouse.edit-group');
	Route::put('update-zone-group/{id}','WarehouseController@UpdateZoneGroup')->name('warehouse.update-zone-group');
	Route::delete('delete-zone-group/{id}','WarehouseController@DeleteZoneGroup')->name('warehouse.delete-zone-group');

	/*bin*/
	Route::get('bin_csv', 'WarehouseController@DownloadBinTemplate')->name('warehouse.bin_csv');
	Route::get('bin_csv_bulk/{id}', 'WarehouseController@BinCsvshowForm')->name('warehouse.bin_csv_bulk');

	Route::post('bin_csv_import', 'WarehouseController@ImportBinTemplate')->name('warehouse.bin_csv_import');

	Route::get('index-bin/{warehouse}', 'WarehouseController@IndexBin')->name('warehouse.index-bin');
	Route::post('index-bin/bin_consolidate_data', 'WarehouseController@IndexBinConsolidateData')->name('warehouse.consolidate_data');

	Route::post('create-bin','WarehouseController@CreateBin')->name('warehouse.create-bin');
	Route::get('edit-bin/{id}', 'WarehouseController@EditBin')->name('warehouse.edit-bin');
	Route::put('update-bin/{id}','WarehouseController@UpdateBin')->name('warehouse.update-bin');
	Route::delete('delete-bin/{id}','WarehouseController@DeleteBin')->name('warehouse.delete-bin');

	Route::resource('warehouse', 'WarehouseController');
