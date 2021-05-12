<?php
	Route::post('/banner_list','Api\BannerController@bannerList');
	Route::post('/banner_list_create','Api\BannerController@bannerListCreate');

	Route::post('/banner_list_update','Api\BannerController@bannerListUpdate');
?>