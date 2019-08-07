<?php

use Illuminate\Http\Request;

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

Route::get('/user/create', 'UserController@store');
Route::get('/user/show', 'UserController@show');
Route::get('/user/destroy', 'UserController@destroy');
Route::get('/user/update', 'UserController@update');

Route::get('/user/login', 'UserController@login');

