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

Route::get('/', 'App\Http\Controllers\PostController@index')->name('home');
Route::get('/article/{slug}', 'App\Http\Controllers\PostController@show')->name('posts.single');
Route::get('/category/{slug}', 'App\Http\Controllers\CategoryController@show')->name('category.single');
Route::get('/tag/{slug}', 'App\Http\Controllers\TagController@show')->name('tag.single');

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('posts', 'PostController');
});



Route::group(['middleware' => 'guest', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');
    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');

});

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');
