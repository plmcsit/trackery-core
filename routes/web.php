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

Route::get('/', 'HomeController@index');
Route::get('home/', 'HomeController@index');
Route::get('found/', 'FoundController@index');
Route::get('find/', 'FindController@index');

Route::post('found/','FoundController@upload');
Route::post('find/','FindController@upload');