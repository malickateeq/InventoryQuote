<?php

use Illuminate\Support\Facades\Route;

Route::get('clear', function () {
    // // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    print "Cache has been cleared successfully!";
});

Route::get('/', 'SiteController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Shipment Controller
Route::post('/get_quote_step1', 'ShipmentController@get_quote_step1')->name('get_quote_step1');

Route::get('/get_quote_step2', 'SiteController@get_quote_step2')->name('get_quote_step2');
Route::post('/form_quote_step2', 'ShipmentController@form_quote_step2')->name('form_quote_step2');

// User Routes
Route::get('/user', 'UserController@index')->name('user');

// vendor Routes
Route::get('/ven', 'VendorController@index')->name('vendor');

// admin Routes
Route::get('/admin', 'AdminController@index')->name('admin');
