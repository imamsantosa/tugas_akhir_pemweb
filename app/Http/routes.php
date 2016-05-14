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

//Route::get('api/v1/post', 'PostController@index');
//Route::get('api/v1/post/view/{id}', 'PostController@view');

//Route::get('api/v1/user', 'UserController@index');
//Route::get('api/v1/user/view/{id}', 'UserController@view');
//Route::post('api/v1/user/update/{id}', 'UserController@update');

Route::group(['prefix' => 'api/v1'], function() {

    Route::group(['prefix' => 'user'], function() {

        Route::get('/', 'UserController@index');
        Route::get('view/{id}', 'UserController@view');
        Route::post('update/{id}', 'UserController@update');
        Route::get('delete/{id}', 'UserController@delete');

    });

    Route::group(['prefix' => 'post'], function() {

        Route::get('/', 'PostController@index');
        Route::post('create', 'PostController@create');
        Route::get('view/{id}', 'PostController@view');
        Route::post('update/{id}', 'PostController@update');
        Route::get('delete/{id}', 'PostController@delete');

    });

    Route::group(['prefix' => 'comment'], function() {
        Route::get('/', 'CommentController@index');
        Route::get('view/{id}', 'CommentController@view');
        Route::post('create', 'CommentController@create');
        Route::post('update/{id}', 'CommentController@update');
        Route::get('delete/{id}', 'CommentController@delete');
    });

});