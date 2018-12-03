<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('disbursements', 'DisbursementController@index')->name('disbursements');
Route::get('disbursements/search', 'DisbursementController@search')->name('disbursements.search');
Route::get('disbursements/{disbursement}', 'DisbursementController@show')->name('disbursement');

Route::get('wallets', 'WalletController@index')->name('wallets');
Route::get('wallets/search', 'WalletController@search')->name('wallets.search');
Route::get('wallets/{wallet}', 'WalletController@show')->name('wallet');
