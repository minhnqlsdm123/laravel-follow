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

Auth::routes();

Route::get('users', 'HomeController@users')->name('users');
Route::get('user/{id}', 'HomeController@user')->name('user.view');
Route::post('follow', 'HomeController@follwUserRequest')->name('follow');

Route::get('posts','PostController@posts')->name('posts');
Route::post('like','PostController@LikePostRequest')->name('like');

Route::get('/home', 'HomeController@index')->name('home');
