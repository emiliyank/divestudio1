<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/ads', 'AdController@index');
Route::get('/ad', 'AdController@add_form');
Route::post('/ad', 'AdController@add_submit');
Route::get('/ad/{cm_ad}', 'AdController@single_ad');
