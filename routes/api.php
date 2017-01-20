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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'games'], function () {
    Route::get('{title}/info', 'ApiController@info');
    Route::get('{title}/comments', 'ApiController@comments');
    Route::get('{title}/header', 'ApiController@header');
    Route::get('{title}/leaderboard', 'ApiController@leaderboard');
    Route::get('{title}/related_games', 'ApiController@related_games');
});
