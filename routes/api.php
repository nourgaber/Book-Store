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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');
    Route::get('testemail/{token}', 'EmailController@sendEmail');

  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('/user/show', 'UserController@show');
        Route::get('/user/index', 'UserController@index');
        Route::get('/user/destroy', 'UserController@destroy');
        Route::get('/user/update', 'UserController@update');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group([       
    'prefix' => 'Book'
], function () {    
    Route::delete('delete', 'BookController@delete');
    Route::get('show', 'BookController@show');
    Route::get('index', 'BookController@index');
    Route::post('store', 'BookController@store');
    Route::put('update', 'BookController@update');

});

Route::get('/user/index', 'UserController@index');


