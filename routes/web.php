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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/user/profile', 'User\ProfileController@index')->name('user.profile')->middleware('auth');
Route::post('/user/profile', 'User\ProfileController@update')->middleware('auth');

Route::get('/user/password', 'User\PasswordController@index')->name('user.password')->middleware('auth');
Route::post('/user/password', 'User\PasswordController@update')->middleware('auth');
