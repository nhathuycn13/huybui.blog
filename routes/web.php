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

Route::group(['namespace' => 'User'], function (){
    Route::get('/', ['as' => 'getHome', 'uses' => 'HomeController@index']);
    Route::get('/category/{category}.html', ['as' => 'getCategory', 'uses' => 'CategoryController@index']);
    Route::get('/post/{post}.html', ['as' => 'post', 'uses' => 'PostController@index']);
    Route::get('/contact.html', ['as' => 'getContact', 'uses' => 'ContactController@index']);
    Route::post('/contact.html', ['as' => 'postContact', 'uses' => 'ContactController@doFeedback']);
    Route::get('/about.html', ['as' => 'getAbout', 'uses' => 'AboutController@index']);
});

// login area
Route::get('/login.html', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
Route::post('/logout.html', ['as' => 'postLogout', 'uses' => 'LoginController@postLogout']);

// admin area

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function (){
    Route::get('/dashboard', ['as' => 'getDashboard', 'uses' => 'GetViewController@dashboard']);
    Route::get('/category', ['as' => 'getCategory', 'uses' => 'GetViewController@category']);
    Route::get('/post', ['as' => 'getPost', 'uses' => 'GetViewController@post']);
    Route::get('/config-information', ['as' => 'getConfigInformation', 'uses' => 'GetViewController@configInformation']);
    Route::get('/config-personal', ['as' => 'getConfigPersonal', 'uses' => 'GetViewController@configPersonal']);
    Route::get('/feedback', ['as' => 'getFeedback', 'uses' => 'GetViewController@feedback']);


    Route::group(['prefix' => 'api', 'namespace' => 'Api'], function (){
//        search
        Route::group(['prefix' => 'search'], function (){
            Route::get('category/{keyword}', 'CategoryController@search');
            Route::get('post/{keyword}', 'CategoryController@search');
            Route::get('tag/{keyword}', 'TagController@search');
        });

        Route::resource('category', 'CategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
        Route::resource('post', 'PostController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
        Route::resource('feedback', 'FeedbackController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

//        tag's area
        Route::get('tag', ['as' => 'getTag', 'uses' => 'TagController@index']);
        Route::post('tag', ['as' => 'postTag', 'uses' => 'TagController@store']);
//        config area
        Route::get('config-information', ['as' =>'getConfigInformationApi', 'uses' => 'ConfigController@getConfig']);
        Route::post('config-information', ['as' =>'updateConfigInformation', 'uses' => 'ConfigController@updateConfig']);

        Route::get('config-personal', ['as' =>'getConfigSersonalApi', 'uses' => 'ConfigController@getUser']);
        Route::post('config-personal', ['as' =>'updateConfigPersonal', 'uses' => 'ConfigController@updateUser']);
    });
});
