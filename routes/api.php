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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');

Route::get('status', 'endpoints\StatusController@index');
Route::get('movements', 'endpoints\MovementController@index');



Route::group(['middleware' => 'auth:api', ], function () {
    Route::get('me', 'AuthController@me');

    Route::patch('lineup', 'LineupController@lineup');
    Route::patch('drop', 'TransactionController@drop');
    Route::patch('add', 'TransactionController@add');
    Route::patch('scout', 'RosterController@scout');
    Route::patch('block', 'RosterController@block');
    Route::patch('keeper', 'RosterController@keeper');
    Route::patch('need', 'RosterController@need');

    Route::get('trades', 'endpoints\TradeController@index');
    Route::get('trades/{franchise}', 'endpoints\TradeController@show');
    Route::post('trade', 'transactionController@trade');
    Route::post('trade/withdraw', 'transactionController@withdraw');

    Route::group(['prefix' => 'w{week}'], function () {
        Route::get('franchises', 'endpoints\FranchiseController@index');
        Route::get('franchises/{franchise}', 'endpoints\FranchiseController@show');

        Route::get('players', 'endpoints\PlayerController@players');
        Route::get('standings', 'endpoints\StandingController@index');

        Route::get('skaters/{player}', 'endpoints\PlayerController@skater')->name('skater');
        Route::get('goalies/{player}', 'endpoints\PlayerController@goalie')->name('goalie');
        Route::get('teams/{player}', 'endpoints\PlayerController@team')->name('team');
    });
});
