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

Route::get('/view_game', function() {
    return view('view_game');
});


Route::get('/admin', function () {
    return view('admin');
});

Route::get('/create', function () {
    return view('create');
});

Route::get('/read', function () {
    return view('read');
});

Route::get('/update', function () {
    return view('update');
});

Route::get('/delete', function () {
    return view('delete');
});

Route::get('/pruebas', function () {
    return view('pruebas');
});

Route::get('/auth', 'UserController@login_register');
Route::get('/authenticate', 'UserController@authenticate');
Route::post('/registrar', 'UserController@registrar');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/addresses','AddressController@index');
Route::get('/address/{id}','AddressController@show');
Route::post('/address/create','AddressController@store');
Route::put('/address/update/{id}','AddressController@update');
Route::delete('/address/delete/{id}','AddressController@destroy');
Route::get('/address/softdelete/{id}','AddressController@soft');
Route::put('/address/restore/{id}','AddressController@restore');

Route::get('/age_restrictions', 'Age_restrictionController@index');
Route::get('/age_restriction/{id}', 'Age_restrictionController@show');
Route::post('/age_restriction/create', 'Age_restrictionController@store');
Route::put('/age_restriction/update/{id}', 'Age_restrictionController@update');
Route::delete('/age_restriction/delete/{id}', 'Age_restrictionController@destroy');
Route::get('/age_restriction/softdelete/{id}','Age_restrictionController@soft');
Route::put('/age_restriction/restore/{id}','Age_restrictionController@restore');

Route::get('/cards', 'CardController@index');
Route::get('/card/{id}', 'CardController@show');
Route::post('/card/create', 'CardController@store');
Route::put('/card/update/{id}', 'CardController@update');
Route::delete('/card/delete/{id}', 'CardController@destroy');
Route::get('/card/softdelete/{id}','CardController@soft');
Route::put('/card/restore/{id}','CardController@restore');

Route::get('/comment_types', 'Comment_typeController@index');
Route::get('/comment_type/{id}', 'Comment_typeController@show');
Route::post('/comment_type/create', 'Comment_typeController@store');
Route::put('/comment_type/update/{id}', 'Comment_typeController@update');
Route::delete('/comment_type/delete/{id}', 'Comment_typeController@destroy');
Route::get('/comment_type/softdelete/{id}','Comment_typeController@soft');
Route::put('/comment_type/restore/{id}','Comment_typeController@restore');

Route::get('/comments', 'CommentController@index');
Route::get('/comment/{id}', 'CommentController@show');
Route::post('/comment/create', 'CommentController@store');
Route::put('/comment/update/{id}', 'CommentController@update');
Route::delete('/comment/delete/{id}', 'CommentController@destroy');
Route::get('/comment/softdelete/{id}','CommentController@soft');
Route::put('/comment/restore/{id}','CommentController@restore');

Route::get('/currencies', 'CurrencyController@index');
Route::get('/currency/{id}', 'CurrencyController@show');
Route::post('/currency/create', 'CurrencyController@store');
Route::put('/currency/update/{id}', 'CurrencyController@update');
Route::delete('/currency/delete/{id}', 'CurrencyController@destroy');
Route::get('/currency/softdelete/{id}','CurrencyController@soft');
Route::put('/currency/restore/{id}','CurrencyController@restore');

Route::get('/friends', 'FriendController@index');
Route::get('/friend/{id}', 'FriendController@show');
Route::post('/friend/create', 'FriendController@store');
Route::put('/friend/update/{id}', 'FriendController@update');
Route::delete('/friend/delete/{id}', 'FriendController@destroy');
Route::get('/friend/softdelete/{id}','FriendController@soft');
Route::put('/friend/restore/{id}','FriendController@restore');

Route::get('/game_genres', 'Game_genreController@index');
Route::get('/game_genre/{id}', 'Game_genreController@show');
Route::post('/game_genre/create', 'Game_genreController@store');
Route::put('/game_genre/update/{id}', 'Game_genreController@update');
Route::delete('/game_genre/delete/{id}', 'Game_genreController@destroy');
Route::get('/game_genre/softdelete/{id}','Game_genreController@soft');
Route::put('/game_genre/restore/{id}','Game_genreController@restore');

Route::get('/game_languages', 'Game_languageController@index');
Route::get('/game_language/{id}', 'Game_languageController@show');
Route::post('/game_language/create', 'Game_languageController@store');
Route::put('/game_language/update/{id}', 'Game_languageController@update');
Route::delete('/game_language/delete/{id}', 'Game_languageController@destroy');
Route::get('/game_language/softdelete/{id}','Game_languageController@soft');
Route::put('/game_language/restore/{id}','Game_languageController@restore');


Route::get('/create_game', 'GameController@fetch');
Route::get('/games', 'GameController@index');
Route::get('/game/{id}', 'GameController@show');
Route::post('/game/create', 'GameController@store');
Route::put('/game/update/{id}', 'GameController@update');
Route::delete('/game/delete/{id}', 'GameController@destroy');
Route::get('/game/softdelete/{id}','GameController@soft');
Route::put('/game/restore/{id}','GameController@restore');

Route::get('/genres', 'GenreController@index');
Route::get('/genre/{id}', 'GenreController@show');
Route::post('/genre/create', 'GenreController@store');
Route::put('/genre/update/{id}', 'GenreController@update');
Route::delete('/genre/delete/{id}', 'GenreController@destroy');
Route::get('/genre/softdelete/{id}','GenreController@soft');
Route::put('/genre/restore/{id}','GenreController@restore');

Route::get('/invoices', 'InvoiceController@index');
Route::get('/invoice/{id}', 'InvoiceController@show');
Route::post('/invoice/create', 'InvoiceController@store');
Route::put('/invoice/update/{id}', 'InvoiceController@update');
Route::delete('/invoice/delete/{id}', 'InvoiceController@destroy');
Route::get('/invoice/softdelete/{id}','InvoiceController@soft');
Route::put('/invoice/restore/{id}','InvoiceController@restore');

Route::get('/languages', 'LanguageController@index');
Route::get('/language/{id}', 'LanguageController@show');
Route::post('/language/create', 'LanguageController@store');
Route::put('/language/update/{id}', 'LanguageController@update');
Route::delete('/language/delete/{id}', 'LanguageController@destroy');
Route::get('/language/softdelete/{id}','LanguageController@soft');
Route::put('/language/restore/{id}','LanguageController@restore');

Route::get('/libraries', 'LibraryController@index');
Route::get('/library/{id}', 'LibraryController@show');
Route::post('/library/create', 'LibraryController@store');
Route::put('/library/update/{id}', 'LibraryController@update');
Route::delete('/library/delete/{id}', 'LibraryController@destroy');
Route::get('/library/softdelete/{id}','LibraryController@soft');
Route::put('/library/restore/{id}','LibraryController@restore');

Route::get('/methods', 'MethodController@index');
Route::get('/method/{id}', 'MethodController@show');
Route::post('/method/create', 'MethodController@store');
Route::put('/method/update/{id}', 'MethodController@update');
Route::delete('/method/delete/{id}', 'MethodController@destroy');
Route::get('/method/softdelete/{id}','MethodController@soft');
Route::put('/method/restore/{id}','MethodController@restore');

Route::get('/permissions', 'PermissionController@index');
Route::get('/permission/{id}', 'PermissionController@show');
Route::post('/permission/create', 'PermissionController@store');
Route::put('/permission/update/{id}', 'PermissionController@update');
Route::delete('/permission/delete/{id}', 'PermissionController@destroy');
Route::get('/permission/softdelete/{id}','PermissionController@soft');
Route::put('/permission/restore/{id}','PermissionController@restore');

Route::get('/purchases', 'PurchaseController@index');
Route::get('/purchase/{id}', 'PurchaseController@show');
Route::post('/purchase/create', 'PurchaseController@store');
Route::put('/purchase/update/{id}', 'PurchaseController@update');
Route::delete('/purchase/delete/{id}', 'PurchaseController@destroy');
Route::get('/purchase/softdelete/{id}','PurchaseController@soft');
Route::put('/purchase/restore/{id}','PurchaseController@restore');

Route::get('/requirements', 'RequirementController@index');
Route::get('/requirement/{id}', 'RequirementController@show');
Route::post('/requirement/create', 'RequirementController@store');
Route::put('/requirement/update/{id}', 'RequirementController@update');
Route::delete('/requirement/delete/{id}', 'RequirementController@destroy');
Route::get('/requirement/softdelete/{id}','RequirementController@soft');
Route::put('/requirement/restore/{id}','RequirementController@restore');

Route::get('/role_permissions', 'Role_permissionController@index');
Route::get('/role_permission/{id}', 'Role_permissionController@show');
Route::post('/role_permission/create', 'Role_permissionController@store');
Route::put('/role_permission/update/{id}', 'Role_permissionController@update');
Route::delete('/role_permission/delete/{id}', 'Role_permissionController@destroy');
Route::get('/role_permission/softdelete/{id}','Role_permissionController@soft');
Route::put('/role_permission/restore/{id}','Role_permissionController@restore');

Route::get('/roles', 'RoleController@index');
Route::get('/role/{id}', 'RoleController@show');
Route::post('/role/create', 'RoleController@store');
Route::put('/role/update/{id}', 'RoleController@update');
Route::delete('/role/delete/{id}', 'RoleController@destroy');
Route::get('/role/softdelete/{id}','RoleController@soft');
Route::put('/role/restore/{id}','RoleController@restore');

Route::get('/user_games', 'User_gameController@index');
Route::get('/user_game/{id}', 'User_gameController@show');
Route::post('/user_game/create', 'User_gameController@store');
Route::put('/user_game/update/{id}', 'User_gameController@update');
Route::delete('/user_game/delete/{id}', 'User_gameController@destroy');
Route::get('/user_game/softdelete/{id}','User_gameController@soft');
Route::put('/user_game/restore/{id}','User_gameController@restore');

Route::get('/user_methods', 'User_methodController@index');
Route::get('/user_method/{id}', 'User_methodController@show');
Route::post('/user_method/create', 'User_methodController@store');
Route::put('/user_method/update/{id}', 'User_methodController@update');
Route::delete('/user_method/delete/{id}', 'User_methodController@destroy');
Route::get('/user_method/softdelete/{id}','User_methodController@soft');
Route::put('/user_method/restore/{id}','User_methodController@restore');

Route::get('/cuenta', 'UserController@cuenta');
Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user/create', 'UserController@store');
Route::put('/user/update/{id}', 'UserController@update');
Route::delete('/user/delete/{id}', 'UserController@destroy');
Route::get('/user/softdelete/{id}','UserController@soft');
Route::put('/user/restore/{id}','UserController@restore');


Route::get('/wallets', 'WalletController@index');
Route::get('/wallet/{id}', 'WalletController@show');
Route::post('/wallet/create', 'WalletController@store');
Route::put('/wallet/update/{id}', 'WalletController@update');
Route::delete('/wallet/delete/{id}', 'WalletController@destroy');
Route::get('/wallet/softdelete/{id}','WalletController@soft');
Route::put('/wallet/restore/{id}','WalletController@restore');

Route::get('/wish_games', 'Wish_gameController@index');
Route::get('/wish_game/{id}', 'Wish_gameController@show');
Route::post('/wish_game/create', 'Wish_gameController@store');
Route::put('/wish_game/update/{id}', 'Wish_gameController@update');
Route::delete('/wish_game/delete/{id}', 'Wish_gameController@destroy');
Route::get('/wish_game/softdelete/{id}','Wish_gameController@soft');
Route::put('/wish_game/restore/{id}','Wish_gameController@restore');
