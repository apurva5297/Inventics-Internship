<?php
	// warehouses
	Route::delete('warehouse/{warehouse}/trash', 'WarehouseController@trash')->name('warehouse.trash'); // warehouse move to trash 
	
	// Route::get('warehouse/{warehouse}/restore', 'WarehouseController@restore')->name('warehouse.restore');
	// Route::get('create-zone-group/{warehouse}', 'WarehouseController@IndexZoneGroup')->name('warehouse.create-zone-group');
	// Route::post('submit-zone-group', 'WarehouseController@CreateZoneGroup')->name('warehouse.submit-zone-group');

	// Route::get('edit-group/{warehouse}', 'WarehouseController@EditZoneGroup')->name('warehouse.edit-group');
	// Route::put('update-zone-group/{id}','WarehouseController@UpdateZoneGroup')->name('warehouse.update-zone-group');
	// Route::delete('delete-zone-group/{id}','WarehouseController@DeleteZoneGroup')->name('warehouse.delete-zone-group');

	// /*bin*/
	// Route::get('bin_csv', 'WarehouseController@DownloadBinTemplate')->name('warehouse.bin_csv');
	// Route::get('bin_csv_bulk/{id}', 'WarehouseController@BinCsvshowForm')->name('warehouse.bin_csv_bulk');

	// Route::post('bin_csv_import', 'WarehouseController@ImportBinTemplate')->name('warehouse.bin_csv_import');

	// Route::get('index-bin/{warehouse}', 'WarehouseController@IndexBin')->name('warehouse.index-bin');
	// Route::post('create-bin','WarehouseController@CreateBin')->name('warehouse.create-bin');
	// Route::get('edit-bin/{id}', 'WarehouseController@EditBin')->name('warehouse.edit-bin');
	// Route::put('update-bin/{id}','WarehouseController@UpdateBin')->name('warehouse.update-bin');
	// Route::delete('delete-bin/{id}','WarehouseController@DeleteBin')->name('warehouse.delete-bin');
	Route::get('pricelist/bulk/{id}', 'PriceListController@PricelistshowForm')->name('pricelist.bulk');
	Route::post('pricelist/pricelist_upload', 'PriceListController@PriceListUpload')->name('pricelist.pricelist_upload');

	Route::resource('pricelist', 'PriceListController');

	Route::get('add-price-list/{type}', 'PriceListController@addPriceList')->name('pricelist.add-price-list');

	Route::delete('pricelist/{id}/trash', 'PriceListController@trash')->name('pricelist.trash'); 

	Route::get('pricelist_csv/{id}', 'PriceListController@DownloadPriceListTemplate')->name('pricelist.pricelist_csv');

	Route::get('create_new', 'PriceListController@create')->name('pricelist.create_new');
	Route::get('marketplace', 'PriceListController@ShopMarketplace')->name('pricelist.marketplace');

	Route::get('listing', 'PriceListController@MarketPlaceListing')->name('pricelist.listing');

	Route::get('marketplace-inventory', 'PriceListController@MarketPlaceInventory')->name('pricelist.marketplace-inventory');

	Route::get('pricelist/marketplacebulk/{id}', 'PriceListController@MarketPlaceshowForm')->name('pricelist.marketplacebulk');
	
	//flipkart data sync(Neha)
	Route::get('marketplace/upload/page/{id}', 'PriceListController@MarketPlaceUploadCsvPage')->name('marketplace.page');
	Route::post('marketplace/upload', 'PriceListController@MarketPlaceUploadCsv')->name('marketplace.upload');


	// Route::post('pricelist/marketplace_upload', function(){
	// 	return "ok";
	// })->name('pricelist.marketplace_upload');
	Route::post('pricelist/marketplace_upload', 'PriceListController@MarketPlaceUpload')->name('pricelist.marketplace_upload');


	Route::get('marketplace-pricelist', 'PriceListController@MarketPlacePriceList')->name('pricelist.marketplace-pricelist');
	Route::get('marketplace-warehouse', 'PriceListController@MarketPlaceWarehouse')->name('pricelist.marketplace-warehouse');

	Route::get('pricelist/marketplacePriceList/{id}', 'PriceListController@MarketPlaceshowFormPriceList')->name('pricelist.marketplacePriceList');
	Route::post('pricelist/marketplace_pricelist', 'PriceListController@MarketPlacePriceListStore')->name('pricelist.marketplace_pricelist');
	Route::delete('pricelist/marketplacePriceListDelete/{id}','PriceListController@MarketplacePriceListDelete')->name('pricelist.marketplacePriceListDelete');

	Route::get('pricelist/marketplacewarehouse/{id}', 'PriceListController@MarketPlaceshowFormWarehouse')->name('pricelist.marketplacewarehouse');

	Route::post('pricelist/marketplace_add_warehouse', 'PriceListController@MarketPlaceAddWarehouse')->name('pricelist.marketplace_add_warehouse');

	Route::delete('pricelist/marketplaceWarehouseDelete/{id}','PriceListController@marketplaceWarehouseDelete')->name('pricelist.marketplaceWarehouseDelete');

	/*orders*/
	Route::get('marketplace-orders', 'PriceListController@MarketPlaceOrders')->name('pricelist.marketplace-orders');
    Route::get('marketplace-return', 'PriceListController@MarketPlaceReturn')->name('pricelist.marketplace-return');
    Route::get('marketplace-payment', 'PriceListController@MarketPlacePaymentOrders')->name('pricelist.marketplace-payment');
    Route::get('marketplace-report', 'PriceListController@MarketPlacePaymentOrders')->name('pricelist.marketplace-report');

    Route::get('marketplace-report-type', 'PriceListController@MarketPlaceReportType')->name('pricelist.marketplace-report-type');
    Route::post('pricelist/marketplace_report', 'PriceListController@MarketPlaceReport')->name('pricelist.marketplace_report');

    Route::get('marketplace-report-type', 'PriceListController@MarketPlaceReportType')->name('pricelist.marketplace-report-type');
/*marketplace_upload*/

/* Previous Order */
Route::get('marketplace-previous-orders', 'PriceListController@MarketPlacePreviousOrders')->name('pricelist.marketplace-orders');
	// warehouse move to trash 

Route::get('marketplace-listing', 'PriceListController@MarketplaceListings');

Route::get('marketplace-listing-create', 'PriceListController@MarketplaceListingCreate');

Route::post('marketplace_listing_upload', 'PriceListController@MarketplaceListingUpload');
