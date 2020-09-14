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

// Single routes with functions
Route::get('/email/error', function () {
    return view('auth.passwords.error');
});
Route::get('/test', function () {
    return view('usersEmails.ChatMailsUi');
});
Route::get('/welcome', function () {
    return view('landingpage');
});


// Auth routes
Auth::routes(['verify'=>true]);//set ['verify'=>true] if you want user to verify

// resource routes
Route::resource('chat', 'ChatController');
Route::resource('userinfo', 'UserinfoController');
Route::resource('profile', 'ProfileController');
Route::resource('post', 'PostController');
Route::resource('like', 'LikeController');
Route::resource('love', 'LoveController');
Route::resource('comment', 'CommentController');
Route::resource('follow', 'FollowController');
Route::resource('contactus', 'ContactUsController');

// single routes
Route::post('/passwordreset', 'FollowController@passwordreset');
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@welcome');
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
Route::get('/searchfreind', 'FollowController@searchfreind');
Route::get('/searchpost', 'FollowController@searchpost');
Route::get('/me', 'FollowController@me')->name('me');

//socialite routes
Route::get('/socialite/{provider}', 'Auth\SocialiteController@redirectToProvider');
Route::get('/socialite/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');
