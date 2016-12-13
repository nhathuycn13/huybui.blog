<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function (){

})->name('home');

// login area
Route::get('/login', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
Route::post('/logout', ['as' => 'postLogout', 'uses' => 'LoginController@postLogout']);

// admin area

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function (){
    Route::get('/dashboard', ['as' => 'getDashboard', 'uses' => 'GetViewController@dashboard']);
    Route::get('/category', ['as' => 'getCategory', 'uses' => 'GetViewController@category']);
    Route::get('/post', ['as' => 'getPost', 'uses' => 'GetViewController@post']);


    Route::group(['prefix' => 'api', 'namespace' => 'Api'], function (){
//        search
        Route::group(['prefix' => 'search'], function (){
            Route::get('category/{keyword}', 'CategoryController@search');
            Route::get('post/{keyword}', 'CategoryController@search');
            Route::get('tag/{keyword}', 'TagController@search');
        });

        Route::resource('category', 'CategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
        Route::resource('post', 'PostController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

//        tag's area
        Route::get('tag', ['as' => 'getTag', 'uses' => 'TagController@index']);
        Route::post('tag', ['as' => 'postTag', 'uses' => 'TagController@store']);
    });
});
