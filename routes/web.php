<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function () {

});

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
Route::get('/user/profile', 'UserController@profile')->name('user.profile');
Route::post('/user/update_profile', 'UserController@update_profile')->name('user.update_profile');
// Route::post('/quotation/store', 'UserController@sotre_quotation')->name('quotation.store');

// vendor Routes
Route::get('/ven', 'VendorController@index')->name('vendor');
Route::get('/ven/profile', 'VendorController@profile')->name('vendor.profile');

// admin Routes
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/profile', 'AdminController@profile')->name('admin.profile');

Route::resource('/quotation', 'QuotationController');

// Merging translated file scripts
Route::get('merge_them', function () {

    $arabic="";
    foreach(file( url('public/trans/variables.json') ) as $line) 
    {
        $arabic=$arabic.$line.'+<br>';
    }
    foreach(file( url('public/trans/arabic_translation.json') ) as $line) 
    {
        $from = '/'.preg_quote('+', '/').'/';
        $arabic = preg_replace($from, $line, $arabic, 1);
        // print_r( $arabic);
        // return;
    }
    print_r( $arabic);
});