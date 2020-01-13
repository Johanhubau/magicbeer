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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
    Route::get('/admin/create', function () {
        return view('create');
    })->name('create');
    Route::get('/display', function () {
        return view('display');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
