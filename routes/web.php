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

Route::get('/clubs', 'ClubsController@index')->name('clubs');
Route::get('/clubs/{sportid}-{sportname}', 'ClubsController@index')->name('clubs.sport');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::name('user.')->middleware('auth')->group(function () {
	Route::get('/user/profile', 'User\ProfileController@index')->name('profile');
	Route::post('/user/profile', 'User\ProfileController@update');

	Route::get('/user/invitations', 'User\InvitationsController@index')->name('invitations');
	Route::post('/user/invitations/{invitation}/accept', 'User\InvitationsController@accept')->name('invitations.accept');
	Route::delete('/user/invitations/{invitation}/reject', 'User\InvitationsController@reject')->name('invitations.reject');

	Route::get('/user/password', 'User\PasswordController@index')->name('password');
	Route::post('/user/password', 'User\PasswordController@update');
});

Route::name('club.')->middleware('auth')->group(function () {
	Route::get('/club/{club}/members', 'Club\MembersController@index')->name('members');
	Route::delete('/club/{club}/members/{member}', 'Club\MembersController@remove')->name('members.remove');

	Route::post('/club/{club}/invitations', 'Club\MembersController@add')->name('invitations.add');
	Route::delete('/club/{club}/invitations/{invitation}/remove', 'Club\MembersController@remove')->name('invitations.remove');

	Route::get('/club/{club}/sites', 'Club\SitesController@index')->name('sites');
	Route::post('/club/{club}/sites', 'Club\SitesController@add')->name('sites.add');
	Route::delete('/club/{club}/sites/{site}', 'Club\SitesController@remove')->name('sites.remove');

	Route::get('/club/{club}/sports', 'Club\SportsController@index')->name('sports');
	Route::post('/club/{club}/sports', 'Club\SportsController@add')->name('sports.add');
	Route::delete('/club/{club}/sports/{sport}', 'Club\SportsController@remove')->name('sports.remove');

	Route::get('/club/{club}', 'Club\ClubController@index')->name('edit');
	Route::post('/club/{club}', 'Club\ClubController@update')->name('update');
});
