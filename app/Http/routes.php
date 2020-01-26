<?php

Route::get('/', 'BitcoinController@index');
Route::post('block-height/search', 'BitcoinController@searchBlockHeightPage');

Route::get('block-hash', 'BitcoinController@showBlockHashPage');
Route::post('block-hash/search', 'BitcoinController@searchBlockHash');
Route::post('block-hash/add', 'BitcoinController@searchBlockHash');

Route::get('transaction', 'BitcoinController@showTransactionPage');
Route::post('transaction/search', 'BitcoinController@searchTransaction');
Route::post('transaction/add', 'BitcoinController@searchTransaction');

Route::get('address', 'BitcoinController@showAddressPage');
Route::post('address/search', 'BitcoinController@searchAddress');
Route::post('address/add', 'BitcoinController@searchAddress');