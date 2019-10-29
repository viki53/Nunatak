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
		$clubs = $request->user()->clubs()->withCount('members')->get();
		$user = $request->user()->loadCount('clubs');

		return view('dashboard', [
			'clubs' => $clubs,
			'user' => $user
		]);
	}
}
