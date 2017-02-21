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

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/change', 'HomeController@change')->name('change');
Route::post('/change', 'HomeController@doChange')->name('doChange');

Route::get('/vote', 'VoteController@index')->name('votes');
Route::get('/vote/{id}', 'VoteController@willdo')->name('before');
Route::get('/voting/{id}', 'VoteController@doing')->name('doing');
//Route::get('/voting/{id}/simple', 'VoteController@simple')->name('simple');
Route::get('/voted/{id}', 'VoteController@did')->name('after');
Route::post('/amiok', 'VoteController@amiok')->name('amiok');
Route::post('/create', 'VoteController@create')->name('create');
Route::post('/vote', 'VoteController@vote')->name('vote');

Route::get('/home', function () {
    return redirect()->route('votes');
})->name('home');

Route::get('/schedule', 'ScheduleController@index')->name('schedule');
Route::get('/goto/{date}', 'ScheduleController@goto')->name('goto');
Route::get('/result', 'VoteController@result')->name('result');
Route::get('/discuss', 'DiscussController@index')->name('discuss');
Route::get('/votes/{id}', 'DiscussController@votelog')->name('votelog');
Route::get('/votes', 'DiscussController@index');
//Route::get('/stock', 'StockController@index')->name('stock');

Route::get('duoshuo/in', 'Auth\AuthController@duoshuoin')->name('duoshuoin');
Route::get('duoshuo/login', 'Auth\AuthController@duoshuologin')->name('duoshuologin');
Route::get('duoshuo/logout', 'Auth\AuthController@duoshuout')->name('duoshuout');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
