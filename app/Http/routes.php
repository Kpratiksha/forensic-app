<?php

Route::get('/', 'BitcoinController@index');
Route::post('block-height/search', 'BitcoinController@searchBlockHeightPage');

Route::get('block-hash', 'BitcoinController@showBlockHashPage');
Route::post('block-hash/search', 'BitcoinController@searchBlockHash');

Route::get('transaction', 'BitcoinController@showTransactionPage');
Route::post('transaction/search', 'BitcoinController@searchTransaction');

Route::get('address', 'BitcoinController@showAddressPage');
Route::post('address/search', 'BitcoinController@searchAddress');