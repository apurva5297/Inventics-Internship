<?php
	Route::post('/offers_list','Api\OffersController@offerList'); 
	Route::post('/offers_list_store','Api\OffersController@offerStore');
	Route::post('/offers_list_view','Api\OffersController@offerView');
	Route::post('/offers_list_update','Api\OffersController@offerUpdate');
	Route::post('/offers_list_delete','Api\OffersController@offerDelete'); 
?>