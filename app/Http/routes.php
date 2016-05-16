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

Route::group(['prefix' => 'api/v1'], function() {

    Route::post('register', ['uses' => 'AuthController@register', 'as'=>'register']);
    Route::post('login', ['uses' => 'AuthController@login', 'as'=>'login']);

    Route::group(['prefix' => 'secure', 'middleware' => 'auth'], function(){
        
        Route::group(['prefix' => 'user', 'namespace' => 'UserApi', 'middleware' => 'status', 'admin' => false], function() {
            //implement route for user

            Route::post('like', ['uses' => 'PostController@like', 'as' => 'like']);
            Route::post('unlike', ['uses' => 'PostController@unlike', 'as' => 'unlike']);

        });

        Route::group(['prefix' => 'admin', 'namespace' => 'AdminApi', 'middleware' => 'status', 'admin' => true], function(){
            //implement route for admin
        });

    });
});