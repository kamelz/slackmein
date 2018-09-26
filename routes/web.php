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
Route::post('/channel', 'HomeController@create')->name('slack.channel');
Route::post('/invite/channel', 'HomeController@inviteToChannel')->name('slack.invite.channel');
Route::post('/invite/email', 'HomeController@inviteByEmail')->name('slack.invite.email');
