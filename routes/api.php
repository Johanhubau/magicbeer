<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/transactions', 'Api\TransactionController@store');
Route::get('/houses', 'Api\HouseController@index');
Route::post('/articles/{article}', 'Api\ArticleController@update');
Route::get('/articles', 'Api\ArticleController@index');
Route::post('/articles', 'Api\ArticleController@store');

