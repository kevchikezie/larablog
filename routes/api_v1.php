<?php

Route::group([
	'prefix' => '/admin', 
	'namespace' => 'Admin', 
	'middleware' => 'auth:api'
], function () {
	Route::group(['prefix' => '/categories'], function () {
		Route::get('/', 'CategoryController@index')->name('api.admin.categories.index');
		Route::post('/', 'CategoryController@store')->name('api.admin.categories.store');
		Route::get('/{uid}', 'CategoryController@show')->name('api.admin.categories.show');
		Route::put('/{uid}', 'CategoryController@update')->name('api.admin.categories.update');
		Route::delete('/{uid}', 'CategoryController@destroy')->name('api.admin.categories.destroy');
	});
});
