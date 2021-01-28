<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
Auth::routes();

Route::resource('chat', 'ChatController');
Route::resource('userinfo', 'UserinfoController');
Auth::routes();
// resource routes
Route::resource('chat', 'ChatController');
Route::resource('userinfo', 'UserinfoController');
Route::resource('profile', 'ProfileController');
Route::resource('post', 'PostController');
Route::resource('like', 'LikeController');
Route::resource('love', 'LoveController');
Route::resource('comment', 'CommentController');
Route::resource('follow', 'FollowController');
// single routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/android', 'PostController@Android');
Route::get('/backend', 'PostController@Backend');
Route::get('/frontend', 'PostController@Frontend');
Route::get('/uiux', 'PostController@UIUX');
Route::get('/others', 'PostController@Others');
Route::get('/friendslist', 'ChatController@friendslist');
Route::get('/getcomment/{id}', 'CommentController@getComment');
Route::get('/getpost/{id}', 'PostController@getPost');
Route::get('/followers/{friend_id}', 'FollowController@followers');
Route::get('/following/{user_id}', 'FollowController@following');

// facebook socialite
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderF');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackF');

// google socialite
Route::get('login/google', 'Auth\LoginController@redirectToProviderG');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallbackG');
