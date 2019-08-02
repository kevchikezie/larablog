<?php

Route::group(['prefix' => '/auth', 'namespace' => 'Auth'], function () {
	Route::post('/login', 'LoginController@apiLogin');
	Route::get('/logout', 'LoginController@apiLogout')->middleware('auth:api');
	Route::get('/user', 'LoginController@loggedInUser')->middleware('auth:api');

});
