<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/posts', 'middleware' => ['auth']], function () {
	Route::get('/create', function () {
	    return 'Hello world!';
	})->name('create_post')->middleware('can:create-post');

	Route::post('/create', function () {
	    return 'Hello world!';
	})->name('store_post')->middleware('can:create-post');

	Route::get('/{post}', function (App\Models\Post $post) {
	    return 'This is MY post! It belongs to the viewer.';
	})->name('view_post')->middleware('can:view-post,post');

	Route::get('/{post}/edit', function (App\Models\Post $post) {
	    return 'i can view update page of my post.';
	})->name('edit_post')->middleware('can:update-post,post');

	Route::put('/{post}', function (App\Models\Post $post) {
	    return 'i can update my post.';
	})->name('update_post')->middleware('can:update-post,post');

	Route::delete('/{post}', function (App\Models\Post $post) {
	    return 'deleted my post.';
	})->name('delete_post')->middleware('can:delete-post,post');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
