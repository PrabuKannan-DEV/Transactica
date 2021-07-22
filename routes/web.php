<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

Route::get('/customers/create', 'CustomerController@create')->name('customer.create');
Route::post('/customers', 'CustomerController@store')->name('customer.store');
Route::get('/customers/{customer}', 'CustomerController@show')->name('showCustomer');
Route::get('/customers/{customer}/wallet_activation', 'CustomerController@activateWallet')->name('activateWallet');
Route::get('/wallets/{wallet}/', 'WalletController@show')->name('show_wallet');
Route::get('/wallets/{wallet}/credit', 'WalletController@creditPage');
Route::post('/wallets/{wallet}/credit', 'WalletController@creditHandler');
Route::get('/wallets/{wallet}/withdraw', 'WalletController@withdrawPage');
Route::post('/wallets/{wallet}/withdraw', 'WalletController@withdrawalHandler')->name('withdraw');
Route::get('/wallets/{wallet}/transfer', 'WalletController@transferPage');
Route::post('/wallets/{wallet}/transfer', 'WalletController@transfer');
Route::get('/wallets/{wallet}/transactions', 'WalletController@transactions')->name('transactions');


//Autocomplete
Route::post('/autocomplete',array('as'=>'search_recipient','uses'=>'CustomerController@searchCustomers'));
