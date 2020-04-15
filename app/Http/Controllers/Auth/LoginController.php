<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = 'dashboard';

	protected function authenticated(Request $request, $user)
	{
		$user->load(['clubs']);

		if (count($user->clubs) === 1) {
			return redirect()->route('club.edit', ['club' => $user->clubs->first()]);
		}
		elseif (count($user->clubs) > 1) {
			return redirect()->route('dashboard');
		}

		return redirect()->route('dashboard'); // TODO: redirect to club create form
	}

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}
}
