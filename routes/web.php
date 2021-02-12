<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', 'ImageController@index')->name('posts');

/*Posts*/
Route::get('/posts', 'ImageController@index')->name('posts');
Route::post('/posts', 'ImageController@store')->name('posts.store');
Route::get('posts/{posts}/edit', 'ImageController@edit')->name('post.edit');
Route::put('posts/{posts}', 'ImageController@update')->name('post.update');
Route::get('/posts/new', 'ImageController@create')->name('posts.create');
Route::get('/posts/{post}', 'ImageController@show')->name('posts.show');
Route::get('/posts/{post}', 'ImageController@show')->name('posts.show');
Route::delete('posts/{posts}/delete','ImageController@destroy')->name('post.destroy');


