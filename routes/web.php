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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('threads', 'ThreadsController@index');
Route::get('threads/create', 'ThreadsController@create');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::get('/threads/{channel}', 'ThreadsController@index');
Route::post('threads', 'ThreadsController@store');		 
Route::delete('/replies/{reply}', 'RepliesController@destroy');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::post('/replies/{reply}/favourites', 'FavouritesController@store');		 
Route::delete('/replies/{reply}/favourites', 'FavouritesController@destroy');		 
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store');
