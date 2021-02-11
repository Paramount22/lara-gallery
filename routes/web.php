<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ImageController@index')->name('posts');
Route::post('/posts', 'ImageController@store')->name('posts.store');
Route::get('/posts/new', 'ImageController@create')->name('posts.create');
Route::get('/posts/{post}', 'ImageController@show')->name('posts.show');

