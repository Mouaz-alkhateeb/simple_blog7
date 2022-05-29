<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/','PostController@index');

Auth::routes();
Route::get('/posts','PostController@index');
Route::get('/posts/{id}','PostController@show');
Route::post('/posts/{id}/store','CommentController@store');
Route::get('/category','CategoryController@index');
Route::post('/category/store','CategoryController@store');
Route::get('/categoryPosts/{id}','CategoryController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/statics', 'HomeController@index');

Route::get('/accses_denied','PostController@accses_denied');
Route::group(['middleware'=>'roles','roles'=>['Admin']],function(){
             Route::get('/admin', 'PostController@admin');
             Route::post('/add_role', 'PostController@add_role');
             Route::post('/setting', 'CommentController@setting');
});
Route::group(['middleware'=>'roles','roles'=>['Editor','Admin']],function(){
    Route::get('/editor', 'PostController@editor');
    Route::post('/posts/store','PostController@store');
});
Route::group(['middleware'=>'roles','roles'=>['User','Editor','Admin']],function(){
    Route::post('/like','PostController@like')->name('like');
    Route::post('/dislike','PostController@dislike')->name('dislike');
});



