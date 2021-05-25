

<?php

// Route::get('/config-cache', function() {
//     $exitCode = Artisan::call('config:cache');
//     return 'Config cache cleared';
// });

//  Route::get('/clear-cache', function() {
//      $exitCode = Artisan::call('cache:clear');
//      return 'Application cache cleared';
//  });
 
//  Route::get('/view-clear', function() {
//      $exitCode = Artisan::call('view:clear');
//      return 'View cache cleared';
//  });
// Welcome routes
Route::get("/welcome","WelcomeController@index")->name("welcome.index");
Route::get("/about","WelcomeController@about")->name("welcome.about");
Route::get("/blog","WelcomeController@blog")->name("welcome.blog");
Route::get("/contact","WelcomeController@contact")->name("welcome.contact");
//Route::get("/welcome","WelcomeController@index")->name("welcome.index");

// Common
include('Common.php');

// Front End routes
include('Frontend.php');

// Backoffice routes
include('Backoffice.php');

// Webhooks
// Route::post('webhook/stripe', 'WebhookController@handleStripeCallback'); 		// Stripe
Route::post('stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');
// AJAX routes for get images
// Route::get('order/ajax/taxrate', 'OrderController@ajaxTaxRate')->name('ajax.taxrate');

