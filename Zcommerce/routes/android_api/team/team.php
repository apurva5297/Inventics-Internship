<?php
Route::post('/your_team/{id}/{type}', 'Api\team\TeamController@your_team'); // modified controller

Route::post('request_team/{owner_id}/{type}','Api\team\TeamController@teamRequest'); // modified controller
Route::post('update_request_status_by_member/{id}/{request_id}','Api\team\TeamController@updateRequestStatusByMember'); // modified controller
Route::post('update_request_status_by_owner/{id}/{request_id}','Api\team\TeamController@updateRequestStatusByOwner'); // modified controller
Route::post('update_primary_contact_by_owner/{id}/{member_id}','Api\team\TeamController@makePrimaryContact'); // modified controller
Route::post('update_owner/{id}/{member_id}','Api\team\TeamController@makeOwner'); // modified controller
?>