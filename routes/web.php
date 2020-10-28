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

Route::get('/', 'EntriesController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    Route::resource('entries', 'EntriesController', ['only' => ['store', 'destroy', 'edit', 'update']]);
    
    
    Route::get('accounts/:id', 'AccountsController@show')->name('accounts.show');
    Route::get('accounts/:id/edit', 'AccountsController@edit')->name('accounts.edit');
    Route::put('accounts/:id', 'AccountsController@update')->name('accounts.update');
    
    Route::get('password/:id', 'PasswordController@show')->name('password.show');
    Route::get('password/:id/edit', 'PasswordController@edit')->name('password.edit');
    Route::put('password/:id', 'PasswordController@update')->name('password.update');
    
});


