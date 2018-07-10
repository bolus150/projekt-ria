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


Route::get('/cars', 'CarsController@index');
Route::post('/cars', 'CarsController@store');
Route::get('/cars/{id}', 'CarsController@edit');
Route::put('/cars/{id}', 'CarsController@update');
Route::delete('/cars/{id}', 'CarsController@destroy');