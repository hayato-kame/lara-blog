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

Route::get('/', 'EntriesController@index')->name('top');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function() {
    
    // Resource Controller を登録するときに、
    // Route::resource 以外でルーティングを登録するときは、
    // Route::resource よりも前に Resouce::get などを定義する必要があるらしい。Route::resource を先に定義してしまうと、想定外の動きをしてしまうとのこと。
    
    // リソースをネストさせることもできます。ネストさせる時はドットで区切ります。
 //   Route::get('users.entries/:id', 'EntriesController@show')->name('users.entries.show');
    
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    // showも追加
    Route::resource('entries', 'EntriesController', ['only' => ['show', 'store', 'destroy', 'edit', 'update']]);
    
    
    Route::get('accounts/:id', 'AccountsController@show')->name('accounts.show');
    Route::get('accounts/:id/edit', 'AccountsController@edit')->name('accounts.edit');
    Route::put('accounts/:id', 'AccountsController@update')->name('accounts.update');
    
    Route::get('password/:id', 'PasswordController@show')->name('password.show');
    Route::get('password/:id/edit', 'PasswordController@edit')->name('password.edit');
    Route::put('password/:id', 'PasswordController@update')->name('password.update');
    

    
    
});


