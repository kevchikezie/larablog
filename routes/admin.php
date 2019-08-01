<?php

Route::group( ['middleware' => ['auth']], function() {
	Route::group(['prefix' => '/categories'], function () {
		Route::get('/', 'CategoryController@index')
			->name('admin.categories.index')->middleware('can:view-category');

		Route::get('/create', 'CategoryController@create')
			->name('admin.categories.create')->middleware('can:create-category');

		Route::post('/create', 'CategoryController@store')
			->name('admin.categories.store')->middleware('can:create-category');
		
		Route::get('/{uid}', 'CategoryController@show')
			->name('admin.categories.show')->middleware('can:view-category');

		Route::get('/{uid}/edit', 'CategoryController@edit')
			->name('admin.categories.edit')->middleware('can:update-category');

		Route::put('/{uid}/edit', 'CategoryController@update')
			->name('admin.categories.update')->middleware('can:update-category');

		Route::delete('/{uid}', 'CategoryController@destroy')
			->name('admin.categories.destroy')->middleware('can:delete-category');

	});

	Route::group(['prefix' => '/posts'], function () {
		Route::get('/create', function () {
			dd(route('admin.posts.show', 3));
		    return 'Hello world!';
		})->name('admin.posts.create')->middleware('can:create-post');

		Route::post('/create', function () {
		    return 'Hello world!';
		})->name('admin.posts.store')->middleware('can:create-post');

		Route::get('/{post}', function (App\Models\Post $post) {
		    return 'This is MY post! It belongs to the viewer.';
		})->name('admin.posts.show')->middleware('can:view-post,post');

		Route::get('/{post}/edit', function (App\Models\Post $post) {
		    return 'i can view update page of my post.';
		})->name('admin.posts.edit')->middleware('can:update-post,post');

		Route::put('/{post}', function (App\Models\Post $post) {
		    return 'i can update my post.';
		})->name('admin.posts.update')->middleware('can:update-post,post');

		Route::delete('/{post}', function (App\Models\Post $post) {
		    return 'deleted my post.';
		})->name('admin.posts.destroy')->middleware('can:delete-post,post');

	});

});