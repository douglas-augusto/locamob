<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function (){

        Route::resource('customers', 'CustomerController');
        Route::resource('owners', 'OwnerController');
        Route::resource('properties', 'PropertyController');
        Route::resource('contracts', 'ContractController');
        Route::get('properties/search/owner', 'PropertyController@searchOwner')->name('properties.search.owner');
        Route::get('contracts/search/property', 'ContractController@searchProperty')->name('properties.search.property');
        Route::get('contracts/search/customer', 'ContractController@searchCustomer')->name('properties.search.customer');
        Route::get('contracts/monthly_payments/{contract}', 'ContractController@listMonthly')->name('contracts.monthly_payments');
        Route::post('contracts/monthly_payments/update/{monthly}', 'ContractController@updateMonthly')->name('contracts.monthly_payments.update');
        Route::get('contracts/transfers/{contract}', 'ContractController@listTransfer')->name('contracts.transfers');
        Route::post('contracts/transfers/update/{transfer}', 'ContractController@updateTransfer')->name('contracts.transfers.update');
    });
});
