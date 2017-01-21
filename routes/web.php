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
    return view('index');
});

Route::get('games', function () {
    return view('games');
});

Route::get('games_list', function () {
    return view('games_list');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('{game}/new_comment', function ($game, \Illuminate\Http\Request $request) {

    $user = $request->user();

    $user->comments()->save(new \App\Comment([
        'game_id' => $game->id,
        'comment' => \Illuminate\Support\Facades\Input::get('comment'),
        'rate' => rand(0, 5),
        'date' => '۲ بهمن ۱۳۹۵'
    ]));

})->middleware('auth');
