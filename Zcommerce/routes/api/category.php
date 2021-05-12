<?php
	Route::post('/master_category_list','Api\CategoryController@masterCategoryList'); 
	Route::post('/category_group_list','Api\CategoryController@CategoryGroupList'); 
	Route::post('/sub_category_list','Api\CategoryController@CategorySubGroupList'); 
	Route::post('/category_list','Api\CategoryController@CategoryList'); 

?>