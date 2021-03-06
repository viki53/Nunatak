<?php

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\User;

use App\Http\Resources\Club as ClubResource;
use App\Club;

use App\Http\Resources\Site as SiteResource;
use App\Site;

use App\Http\Resources\Sport as SportResource;
use App\Sport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/me', function (Request $request) {
	return $request->user();
});

Route::get('/users', function () {
    return UserResource::collection(User::paginate());
});
Route::get('/users/{user}', function (User $user) {
    return new UserResource($user->with('clubs')->get());
});

Route::get('/clubs', function () {
    return ClubResource::collection(Club::paginate());
});
Route::get('/clubs/{club}', function (Club $club) {
    return new ClubResource($club->with(['sports', 'users'])->get());
});

Route::get('/sites', function () {
    return SiteResource::collection(Site::paginate());
});
Route::get('/sites/{site}', function (Site $site) {
    return new SiteResource($site->with('club')->get());
});

Route::get('/sports', function () {
    return SportResource::collection(Sport::paginate());
});
Route::get('/sports/{sport}', function (Sport $sport) {
    return new SportResource($sport->with(['clubs'])->get());
});
