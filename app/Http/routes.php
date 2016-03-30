<?php

Blade::setContentTags('<%', '%>');        // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');   // for escaped data



/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function () {
        return view('welcome');
    });

    

    // API ROUTES ==================================  
    Route::group(array('prefix' => 'api'), function() {
        Route::resource('question', 'QuestionController', array('only' => array('index', 'store', 'show', 'update')));
    });

    // API ROUTES ==================================  
    Route::group(array('prefix' => 'api'), function() {
        Route::resource('answer', 'AnswerController', array('only' => array('index', 'store', 'show', 'update')));
    });

    // API ROUTES ==================================  
    Route::group(array('prefix' => 'api'), function() {
        Route::resource('user', 'UserController', array('only' => array('index')));
    });
    
     // API ROUTES ==================================  
    Route::group(array('prefix' => 'api'), function() {
        Route::resource('chat', 'ChatController', array('only' => array('index','store')));
    });

    Route::get('/home', 'HomeController@index');
});

