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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/voters/{voter}/vote', 'VoterController@vote')->name('voters.vote');
    Route::get('/elections/{election}/activate', 'ElectionController@activate')->name('elections.activate');
    Route::resource('voters', 'VoterController');
    Route::resource('offices', 'OfficeController');
    Route::resource('elections', 'ElectionController');
    Route::resource('candidates', 'CandidateController');
    Route::resource('positions', 'PositionController');
    Route::resource('votes', 'VoteController');
});
