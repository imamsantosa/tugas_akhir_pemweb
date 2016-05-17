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

Route::get('login', ['uses' => 'GuestController@login', 'as'=>'login']);
Route::get('register', ['uses' => 'GuestController@register', 'as' => 'register']);

Route::post('auth/login', ['uses' => 'AuthController@login', 'as' => 'auth_login']);
Route::post('auth/register', ['uses' => 'AuthController@register', 'as' => 'auth_register']);
Route::get('auth/logout', ['uses' => 'AuthController@logout', 'as'=>'auth_logout']);

Route::group(['middleware' => 'auth', 'namespace' => 'User'], function(){
    Route::get('/', ['uses' => 'UserController@index', 'as' => 'home']);
    Route::get('upload', ['uses' => 'UploadController@index', 'as' => 'upload_image']);
    Route::post('upload', ['uses' => 'UploadController@upload', 'as' => 'upload_proses']);
});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {

        Route::group(['prefix' => 'user', 'namespace' => 'UserApi', 'middleware' => 'status', 'admin' => false], function() {
            //implement route for user
            Route::post('like', ['uses' => 'PostController@like', 'as' => 'api-user-like']);
            Route::post('unlike', ['uses' => 'PostController@unlike', 'as' => 'api-user-unlike']);
            Route::post('addComment', ['uses' => 'postController@addComment', 'as' => 'addComment']);
        });

        Route::group(['prefix' => 'admin', 'namespace' => 'AdminApi', 'middleware' => 'status', 'admin' => true], function(){
            //implement route for admin
        });
});