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

// Pages
Route::get('/', 'PageController@home')->name('home');
Route::get('/proposal', 'PageController@proposal')->name('proposal');
Route::get('/contributions', 'PageController@contributions')->name('contributions');

// Announcements
Route::get('announcements', 'AnnouncementController@index')->name('announcements');
Route::post('announcements/search', 'AnnouncementController@search')->name('announcements.search');
Route::get('announcements/{announcement}', 'AnnouncementController@show')->name('announcement');

// Blocks
Route::get('blocks', 'BlockController@index')->name('blocks');
Route::post('blocks/search', 'BlockController@search')->name('blocks.search');
Route::get('blocks/{block}', 'BlockController@show')->name('block');

// Disbursements
Route::get('disbursements', 'DisbursementController@index')->name('disbursements');
Route::post('disbursements/search', 'DisbursementController@search')->name('disbursements.search');
Route::get('disbursements/{disbursement}', 'DisbursementController@show')->name('disbursement');

// Wallets
Route::get('wallets', 'WalletController@index')->name('wallets');
Route::post('wallets/search', 'WalletController@search')->name('wallets.search');
Route::get('wallets/{wallet}', 'WalletController@show')->name('wallet');

// Reports
Route::get('reports', 'ReportController@index')->name('reports');
Route::post('reports/search', 'ReportController@search')->name('reports.search');
Route::get('reports/{report}', 'ReportController@show')->name('report');
