<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/addresses','AddressController@index');
Route::get('/address/{id}','AddressController@show');
Route::post('/address/create','AddressController@store');
Route::put('/address/update/{id}','AddressController@update');
Route::delete('/address/delete/{id}','AddressController@destroy');
