<?php

Route::get('/', 'HomeController@index');

Route::get('gallery', 'GalleryController@index');
Route::get('reviews', 'ReviewController@index');

Route::get('register', 'Auth\AuthController@redirectToLoginPage');
Route::post('register', 'Auth\AuthController@postRegister');
