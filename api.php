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
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login','API\PassportController@login');
Route::post('register','API\PassportController@register');
Route::post('getDetails','API\PassportController@getDetails');
Route::middleware('auth:api')->get('/filterDate','API\PassportController@filterDate');
Route::middleware('auth:api')->get('/logout','API\PassportController@logout');
Route::middleware('auth:api')->get('/getDetails','API\PassportController@getDetails');
Route::middleware('auth:api')->post('/submitAttendence','API\PassportController@submitAttendence');

