<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
Route::post('/register', 'AuthController@register');

Route::middleware('auth:sanctum')->group(function () {
	Route::get('/auth_user', 'AuthController@getAuthUser');
	Route::resource('/user', 'UserController');
	Route::resource('/book', 'BookController');
	Route::get('/book/check/{id}', 'BookController@bookAvailabity');
	Route::resource('/loan', 'LoanController');
	Route::resource('/setting', 'SettingController');
});
