<?php

// Home
Route::get('/', 'DashboardController@index')->name('home');

// Notifications
Route::get('notifications/all', 'NotificationController@index')->name('notifications');
Route::get('notifications/read', 'NotificationController@read')->name('notifications.read');
Route::get('notifications/unread', 'NotificationController@unread')->name('notifications.unread');
Route::post('notifications/{notification}/mark-as-read', 'NotificationController@markAsRead')->name('notifications.mark-as-read');

// Lost & Found
Route::get('lost-and-found', 'LostAndFoundController@index')->name('lost-and-found');
Route::post('lost-and-found/search', 'LostAndFoundController@search')->name('lost-and-found.search');
Route::get('lost-and-found/{wallet}', 'LostAndFoundController@claim')->name('lost-and-found.claim');
Route::post('lost-and-found/{wallet}', 'LostAndFoundController@verifyClaim');

// Wallets
Route::get('wallets', 'WalletController@index')->name('wallets');
Route::get('wallets/export', 'WalletController@export')->name('wallets.export');
Route::post('wallets/search', 'WalletController@search')->name('wallets.search');
Route::get('wallets/{wallet}', 'WalletController@show')->name('wallet');
Route::put('wallets/{wallet}', 'WalletController@update')->name('wallets.update');
Route::get('wallets/{wallet}/metrics/{type?}', 'WalletController@metrics')
    ->name('wallet.metrics')
    ->where('type', '(week|month|quarter|year)');

// Disbursements
Route::get('disbursements', 'DisbursementController@index')->name('disbursements');
Route::get('disbursements/export', 'DisbursementController@export')->name('disbursements.export');
Route::post('disbursements/search', 'DisbursementController@search')->name('disbursements.search');
Route::get('disbursements/{disbursement}', 'DisbursementController@show')->name('disbursement');

// Metrics
Route::get('metrics/{type?}', 'MetricsController@index')
    ->name('metrics')
    ->where('type', '(week|month|quarter|year)');

// API Docs
Route::get('api', 'ApiController@index')->name('api');
