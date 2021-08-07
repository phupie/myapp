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
    
    //after login
    Route::middleware('auth:user')->group(function(){
        
        //TOP page
        Route::resource('home', 'HomeController', ['only' => 'index']);
        
        //user
        Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
        
        //follow/unfollow
        Route::post('users/{user}/follow', 'UserController@follow')->name('follow');
        Route::delete('users/{user}/unfollow', 'UserController@unfollow')->name('unfollow');
        
        //profile
        Route::resource('profiles', 'ProfileController', ['only' => ['create', 'store', 'edit', 'update',/*'destroy'*/]]);
        
        //gallery
        Route::resource('galleries', 'GalleryController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        
        //comment
        Route::resource('commnets', 'CommentController', ['only' => ['store']]);
        
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
    });
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
