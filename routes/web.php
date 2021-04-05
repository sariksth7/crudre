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

Route::get('/', 'PostsController@index')->name('sarikwall');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/create_post', 'PostsController@create')->name('create_post');
Route::post('/create_new_post', 'PostsController@store')->name('store_post');

Route::get ('show_post/{id}', 'PostsController@show')->name('display_post');

Route::get('/delete_post/{id}', 'PostsController@destroy')->name('delete_post');


Route::get('/edit_post/{id}','PostsController@edit')->name('edit_post');
Route::post('/update_post/{id}', 'PostsController@update')->name('update_post');


//for comment section

//Route::get('/show_post', 'CommentController@index')->name('comment_post');
Route::post('/comments/{id}', 'CommentController@store')->name('comment.store');

Route::get('/delete_comment/{id}','CommentController@destroy')->name('comment.delete');

//For Like
Route::post('/like', 'LikeController@likePost')->name('like');



//Exporting into Excel


Route::get('/export-post', 'PostsController@excel')->name('export.post');

//Import Excel File
Route::post('/import-post', 'PostImportController@store')->name('import.post');


