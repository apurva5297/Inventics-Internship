<?php
	// Bulk upload routes
	// Route::get('inventory/upload/downloadCategorySlugs', 'InventoryUploadController@downloadCategorySlugs')->name('inventory.downloadCategorySlugs');
	Route::get('inventory/fsn/mapping/page/{id}', 'InventoryUploadController@MappingFsnPage')->name('inventory.fsn.mapping.page');
	Route::post('inventory/fsn/mapping/upload', 'InventoryUploadController@MappingFsnUpload')->name('inventory.fsn.mapping.upload');
	Route::get('inventory/upload/downloadTemplate', 'InventoryUploadController@downloadTemplate')->name('inventory.downloadTemplate');
	Route::get('inventory/upload', 'InventoryUploadController@showForm')->name('inventory.bulk');
	Route::post('inventory/upload', 'InventoryUploadController@upload')->name('inventory.upload');
	Route::post('inventory/inventory_upload', 'InventoryUploadController@inventoryUpload')->name('inventory.inventory_upload');

	// Route::post('inventory/import', 'InventoryUploadController@import')->name('inventory.import');
	// Route::post('inventory/downloadFailedRows', 'InventoryUploadController@downloadFailedRows')->name('inventory.downloadFailedRows');

	// inventorys
	Route::delete('inventory/{inventory}/trash', 'InventoryController@trash')->name('inventory.trash'); // inventory move to trash
	Route::get('inventory/{inventory}/restore', 'InventoryController@restore')->name('inventory.restore');
	// Route::get('inventory/showSearchForm', 'InventoryController@showSearchForm')->name('inventory.showSearchForm');
	// Route::get('inventory/search', 'InventoryController@search')->name('inventory.search');
	Route::get('inventory/setVariant/{inventory}', 'InventoryController@setVariant')->name('inventory.setVariant');
	Route::get('inventory/add/{inventory}', 'InventoryController@add')->name('inventory.add');
	Route::get('inventory/addWithVariant/{inventory}', 'InventoryController@addWithVariant')->name('inventory.addWithVariant');
	Route::post('inventory/storeWithVariant', 'InventoryController@storeWithVariant')->name('inventory.storeWithVariant');
	Route::post('inventory/store', 'InventoryController@store')->name('inventory.store')->middleware('ajax');
	Route::post('inventory/{inventory}/update', 'InventoryController@update')->name('inventory.update')->middleware('ajax');
	Route::get('inventory/{inventory}/editQtt', 'InventoryController@editQtt')->name('inventory.editQtt');
	Route::put('inventory/{inventory}/updateQtt', 'InventoryController@updateQtt')->name('inventory.updateQtt');
	Route::resource('inventory', 'InventoryController', ['except' =>['create', 'store', 'update']]);

    Route::post('ajax_inventory/{type}', 'InventoryController@AjaxInventory')->name('inventory.ajax_inventory');
    Route::post('pricelist_inventory/{type}', 'InventoryController@PricelistInventory')->name('inventory.pricelist_inventory');


	Route::get('inward', 'InventoryController@Inward')->name('inventory.inward');
	Route::post('inward-store', 'InventoryController@InwardStore')->name('inventory.inward-store');
	Route::get('inward_csv', 'InventoryUploadController@DownloadInwardTemplate')->name('inventory.inward_csv');
	Route::get('inward_bulk', 'InventoryUploadController@InwardshowForm')->name('inventory.inward_bulk');
	Route::post('inward_csv_import', 'InventoryUploadController@ImportInwardTemplate')->name('inventory.inward_csv_import');
	
	/*recall*/

	Route::get('recall_bulk', 'InventoryUploadController@RecallshowForm')->name('inventory.recall_bulk');

	Route::get('recall', 'InventoryController@Recall')->name('inventory.recall');

	Route::get('recall_csv', 'InventoryUploadController@DownloadRecallTemplate')->name('inventory.recall_csv');

	Route::post('recall_csv_import', 'InventoryUploadController@ImportRecallTemplate')->name('inventory.recall_csv_import');

	Route::get('get_recall/{id}', 'InventoryUploadController@getRecall')->name('inventory.get_recall');




