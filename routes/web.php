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

Route::get('/lang/{lang}', 'LanguageController@index')->name('language');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/change', 'HomeController@change')->name('change');

Route::get('/vote', 'VoteController@index')->name('votes');
Route::get('/vote/{id}', 'VoteController@willdo')->name('before');
Route::get('/voting/{id}', 'VoteController@doing')->name('doing');
Route::get('/voted/{id}', 'VoteController@willdo')->name('after');
Route::post('/amiok', 'VoteController@amiok')->name('amiok');
Route::post('/create', 'VoteController@create')->name('create');
Route::post('/vote', 'VoteController@vote')->name('vote');

Route::get('/schedule', 'ScheduleController@index')->name('schedule');
Route::get('/discuss', 'DiscussController@index')->name('discuss');
//Route::get('/stock', 'StockController@index')->name('stock');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
