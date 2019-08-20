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
    Route::post('login', 'UserController@login');
    Route::post('signup', 'UserController@signup');
    Route::get('signup/activate/{token}', 'UserController@signupActivate');

  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'UserController@logout');
      

    });
});
Route::get('getAll', 'UserController@getAll');
Route::get('user', 'UserController@user');
Route::group([        
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'UserController@createPassword');
    Route::get('find/{token}', 'UserController@find');
    Route::post('reset', 'UserController@reset');
});

Route::group([       
    'prefix' => 'Book'
], function () {    
    Route::delete('delete', 'BookController@delete');
    Route::get('read', 'BookController@read');
    Route::get('getAll', 'BookController@getAll');
    Route::post('create', 'BookController@create');
    Route::put('update', 'BookController@update');

});
Route::group([       
    'middleware' => 'auth:api',
    'middleware'=>'role',    
    'prefix' => 'user'
], function () {    
    Route::get('destroy', 'UserController@destroy');
    Route::put('update', 'UserController@update');
    Route::get('read', 'UserController@read');

});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});

