<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trello', 'Trello@index');
Route::get('/trello/{idBoard}', 'Trello@userBoard');
Route::put('/trello/createticket', 'Trello@createNewTicket');
Route::get('/trello/ticket/{id}', 'Trello@showTicket');

Route::get('/auth','Trello@setToken');


Route::get('/logout','Trello@logout');