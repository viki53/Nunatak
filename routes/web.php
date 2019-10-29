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

Route::name('user.')->middleware('auth')->group(function () {
	Route::get('/user/profile', 'User\ProfileController@index')->name('profile');
	Route::post('/user/profile', 'User\ProfileController@update');

	Route::get('/user/password', 'User\PasswordController@index')->name('password');
	Route::post('/user/password', 'User\PasswordController@update');
});

Route::name('club.')->middleware('auth')->group(function () {
	Route::get('/club/{id}/members', 'Club\MembersController@index')->name('members');
	Route::delete('/club/{id}/members', 'Club\MembersController@remove')->name('members.remove');

	Route::get('/club/{id}/sports', 'Club\SportsController@index')->name('sports');
	Route::post('/club/{id}/sports', 'Club\SportsController@add')->name('sports.add');
	Route::delete('/club/{id}/sports', 'Club\SportsController@remove')->name('sports.remove');

	Route::get('/club/{id}', 'Club\ClubController@index')->name('edit');
});
