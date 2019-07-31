<?php

Route::group( ['middleware' => ['auth']], function() {

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