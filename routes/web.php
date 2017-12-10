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


Route::get('/', 'ContactController@index');
Route::post('/', 'ContactController@store');
Route::get('{id}/edit','ContactController@edit');
Route::put('update/{id}','ContactController@update');
Route::delete('destroy/{id}','ContactController@destroy');
Route::get('/get-contacts', 'ContactController@getContacts');
