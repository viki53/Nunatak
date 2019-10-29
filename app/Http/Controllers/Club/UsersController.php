<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;

class UsersController extends Controller
{
	/**
	 * Show the club's users list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index($id, Request $request)
	{
		$club = Club::with('members')->withCount('members')->findOrFail($id);

		return view('club.users', [
			'club' => $club,
			'user' => $request->user()
		]);
	}
}
