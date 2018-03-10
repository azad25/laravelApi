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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles', 'ArticleController@index');
Route::get('articles/{id}', 'ArticleController@ishow');
Route::post('article', 'ArticleController@index');
Route::put('article', 'ArticleController@store');
Route::put('article/{id}', 'ArticleController@edit');
Route::delete('articles/{id}', 'ArticleController@destroy');
