<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfile as UpdateUserProfileRequest;

class ProfileController extends Controller
{
	/**
	 * Show the user profile.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		return view('user.profile', [
			'user' => $request->user()
		]);
	}

	/**
	 * Update the user's profile.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function update(UpdateUserProfileRequest $request)
	{
		$validatedData = $request->validated();

		$user = $request->user();

		$user->name = $validatedData['name'];
		$user->email = $validatedData['email'];
		$user->phone = $validatedData['phone'];

		$user->save();

		$request->session()->flash('status', __('Profil mis à jour'));
		return redirect()->route('dashboard');
	}
}
