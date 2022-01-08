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

Route::get('/age_restrictions', 'Age_restrictionController@index');
Route::get('/age_restriction({id}', 'Age_restrictionController@show');
Route::post('/age_restriction/create', 'Age_restrictionController@store');
Route::put('/age_restriction/update/{id}', 'Age_restrictionController@update');
Route::delete('/age_restriction/delete/{id}', 'Age_restrictionController@destroy');

Route::get('/card', 'CardController@index');
Route::get('/card({id}', 'CardController@show');
Route::post('/card/create', 'CardController@store');
Route::put('/card/update/{id}', 'CardController@update');
Route::delete('/card/delete/{id}', 'CardController@destroy');

Route::get('/comment_type', 'Comment_typeController@index');
Route::get('/comment_type({id}', 'Comment_typeController@show');
Route::post('/comment_type/create', 'Comment_typeController@store');
Route::put('/comment_type/update/{id}', 'Comment_typeController@update');
Route::delete('/card/delete/{id}', 'Comment_typeController@destroy');

Route::get('/comment', 'CommentController@index');
Route::get('/comment({id}', 'CommentController@show');
Route::post('/comment/create', 'CommentController@store');
Route::put('/comment/update/{id}', 'CommentController@update');
Route::delete('/comment/delete/{id}', 'CommentController@destroy');

Route::get('/country', 'CountryController@index');
Route::get('/country({id}', 'CountryController@show');
Route::post('/country/create', 'CountryController@store');
Route::put('/country/update/{id}', 'CountryController@update');
Route::delete('/country/delete/{id}', 'CountryController@destroy');