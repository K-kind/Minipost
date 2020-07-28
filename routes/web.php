<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', 'PostsController@index');
// Route::get('/posts/{id}', 'PostsController@show');
Route::get('/users/{user}', 'UsersController@show')->where('user', '[0-9]+');
Route::get('/users/{user}/edit', 'UsersController@edit');
Route::patch('/users/{user}', 'UsersController@update');
Route::delete('/users/{user}', 'UsersController@destroy');
// Route::get('/posts/create', 'PostsController@create');
// Route::post('/posts', 'PostsController@store');
// Route::get('/posts/{post}/edit', 'PostsController@edit');
// Route::patch('/posts/{post}', 'PostsController@update');
// Route::post('/posts/{post}/comments', 'CommentsController@store');
// Route::delete('/posts/{post}/comments/{comment}', 'CommentsController@destroy');
