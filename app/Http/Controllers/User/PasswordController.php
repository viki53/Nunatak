<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserPassword as UpdateUserPasswordRequest;

class PasswordController extends Controller
{
		/**
		 * Show the password form.
		 *
		 * @return \Illuminate\Contracts\Support\Renderable
		 */
		public function index(Request $request)
		{
				return view('user.password', [
			'user' => $request->user()
		]);
	}

		/**
		 * Update the user's password.
		 *
		 * @param  Request  $request
		 * @return Response
		 */
		public function update(UpdateUserPasswordRequest $request)
		{
		$validatedData = $request->validated();

		$user = $request->user();

		$user->password = bcrypt($validatedData['password']);

		$user->save();

		$request->session()->flash('status', __('Mot de passe mis à jour'));
		return redirect()->route('dashboard');
		}
}
