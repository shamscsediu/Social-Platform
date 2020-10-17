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
//main auth controller
Auth::routes();
//get req controllers
Route::get('/', 'HomeController@index')->name('home');
Route::get('/friend/{uinfo}','FriendsController@index');
Route::get('friends/','FriendsController@find_friend_index');
Route::get('/friends/search_r','FriendsController@search_friends')->name('search_friend');
Route::get('/friends/req_id','FriendsController@send_req')->name('send_req');
Route::get('/friends/del_req_id','FriendsController@cancel_req')->name('cancel_req');
Route::get('friends/status','FriendsController@status_req')->name('status_req');
Route::get('friends/confirmed','FriendsController@con_req')->name('con_req');
Route::get('friends/rejected','FriendsController@rej_req')->name('rej_req');
Route::get('friends/unfrnd','FriendsController@unfrnd')->name('unfrnd');

//Route::get('/friends/result','FriendsController@search_friends');
//post and mixed req controller
Route::resource('profile','ProfileController')->middleware('auth');
Route::post('/fileupload', 'FileUploadController@pro_store')->name('propic');
Route::resource('posts','PostsController')->middleware('auth');
Route::post('posts/{post}/comment','PostsController@commentstore')->middleware('auth')->name('posts.comment');

