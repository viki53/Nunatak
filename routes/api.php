<?php

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\User;

use App\Http\Resources\Club as ClubResource;
use App\Club;

use App\Http\Resources\Site as SiteResource;
use App\Site;

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
    return UserResource::collection(User::with('clubs')->paginate());
});
Route::get('/users/{user}', function (User $user) {
    return new UserResource($user);
});

Route::get('/clubs', function () {
    return ClubResource::collection(Club::with('users')->paginate());
});
Route::get('/clubs/{club}', function (Club $club) {
    return new ClubResource($club);
});

Route::get('/sites', function () {
    return SiteResource::collection(Site::with('club')->paginate());
});
Route::get('/sites/{site}', function (Site $site) {
    return new SiteResource($site);
});
