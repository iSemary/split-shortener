<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'PageController@index');

Route::get('/{path}', 'PageController@view');

Route::get('e/404', 'PageController@not_found')->name('404');

Route::resource('url-shorten', 'UrlShortenController');
