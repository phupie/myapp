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
    });
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::resource('galleries', 'GalleryController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
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
