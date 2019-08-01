<?php

Route::group([
	'prefix' => '/admin', 
	'namespace' => 'Admin', 
	'middleware' => 'auth:api'
], function () {
	Route::group(['prefix' => '/categories'], function () {
		Route::get('/', 'CategoryController@index')->middleware('can:view-category');

	});
});
