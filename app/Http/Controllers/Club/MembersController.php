<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;

class MembersController extends Controller
{
	/**
	 * Show the club's users list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index($id, Request $request)
	{
		$club = Club::with('members')->withCount('members')->findOrFail($id);

		return view('club.members', [
			'club' => $club,
			'user' => $request->user()
		]);
	}

	/**
	 * Remove a club's member.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function remove($id, Request $request)
	{
		$club = Club::findOrFail($id);

		$club->member()->detach($request->input('member_id'));

		$club->save();

		$request->session()->flash('status', __('Membre supprimé'));
		return redirect()->route('club.members', ['id' => $id]);
	}
}
