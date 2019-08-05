<?php

Route::group([
	'prefix' => '/admin', 
	'namespace' => 'Admin', 
	'middleware' => 'auth:api'
], function () {
	Route::group(['prefix' => '/categories'], function () {
		Route::get('/', 'CategoryController@index')->name('api.admin.categories.index');
		Route::post('/', 'CategoryController@store')->name('api.admin.categories.store');

	});
});
