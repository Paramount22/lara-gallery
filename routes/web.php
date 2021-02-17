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
Route::delete('posts/{posts}/delete','ImageController@destroy')->name('post.destroy');

/*Comments*/
Route::resource('comments', 'CommentController' );
Route::get('comment/{comment}/delete', 'CommentController@destroy');

/*Likes*/;
Route::post('/posts/{image}/likes', 'ImageLikeController@store')->name('posts.likes');
Route::post('/posts/{image}/unlikes', 'ImageUnlikeController@store')->name('posts.unlikes');

/*Users*/
Route::get('/user/{user}/posts', 'UserPostController@index')->name('user.posts');



