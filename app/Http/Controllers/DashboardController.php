<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		$user = $request->user()->with(['clubs.sports'])->withCount('clubs')->first();

		foreach($user->clubs as $club) {
			$club->loadCount(['members', 'invitations']);
		}

		return view('dashboard', [
			'protocol' => 'http'.($request->secure() ? 's' : ''),
			'user' => $user,
		]);
	}
}
