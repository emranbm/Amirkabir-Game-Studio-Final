<?php

use App\Game;
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

Route::bind('game', function ($title) {
    return Game::whereTitle($title)->first();
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'games'], function () {
    Route::get('{game}/info', 'ApiController@info');
    Route::get('{game}/comments', 'ApiController@comments');
    Route::get('{game}/header', 'ApiController@header');
    Route::get('{game}/leaderboard', 'ApiController@leaderboard');
    Route::get('{game}/related_games', 'ApiController@related_games');
});
Route::get('home', 'ApiController@home');
