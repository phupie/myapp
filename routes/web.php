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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('User')->prefix('user')->name('user.')->group(function(){
    
    //login
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);
    
    Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
    Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');
    //after login
    Route::middleware('auth:user')->group(function(){
        
        //TOP page
        Route::get('home/all', 'HomeController@all');
        Route::get('home/galleries', 'HomeController@galleries');
        Route::resource('home', 'HomeController', ['only' => 'index']);
        
        //follow/unfollow
        Route::post('users/{user}/follow', 'UserController@follow')->name('follow');
        Route::get('users/{user}/follow_check', 'UserController@follow_check')->name('follow_check');
        
        //user
        Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
        
        //profile
        Route::resource('profiles', 'ProfileController', ['only' => ['create', 'store', 'edit', 'update',/*'destroy'*/]]);
        
        //tag
        Route::get('tags', 'TagController@index');
        
        //gallery
        Route::get('galleries/search', 'GalleryController@search');
        Route::resource('galleries', 'GalleryController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        //comment
        Route::resource('comments', 'CommentController', ['only' => ['store', 'show']]);
        
        //favorite
        Route::post('favorites', 'FavoriteController@favorite')->name('favorite');
        
        //report
        Route::resource('reports', 'ReportController',['only' => ['store', 'destroy']]);
        
        
    });
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    
    //login
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);
    
    //after login
    Route::middleware('auth:admin')->group(function(){
        
        //TOP page
        Route::resource('home', 'HomeController', ['only' => 'index']);
        
        //User
        Route::resource('users', 'UserController', ['only' => ['index', 'destroy']]);
    });
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
