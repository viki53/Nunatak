<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;
use App\ClubPendingMember;
use App\User;
use App\Http\Requests\CreateClubPendingMember as CreateClubPendingMemberRequest;

class MembersController extends Controller
{
	/**
	 * Show the club's users list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Club $club, Request $request)
	{
		$club->load(['members', 'pending_members.user']);

		return view('club.members', [
			'club' => $club,
			'user' => $request->user()
		]);
	}

	/**
	 * Add a member to the club.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function add(Club $club, CreateClubPendingMemberRequest $request)
	{
		$validatedData = $request->validated();

		$member = $club->pending_members()->create([
			'club_id' => $club->id,
			'user_name' => $validatedData['user_name'],
			'user_email' => $validatedData['user_email'],
		]);

		$user = User::where(['email' => $member->user_email])->first();

		if (!empty($user)) {
			$member->user_id = $user->id;
			$member->save();
		}

		$request->session()->flash('status', __('Membre ajouté'));
		return redirect()->route('club.members', ['club' => $club]);
	}

	/**
	 * Remove a club's member.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function remove(Club $club, Request $request)
	{
		$pending_member = ClubPendingMember::findOrFail($request->input('invitation_id'));
		$pending_member->delete();

		$request->session()->flash('status', __('Invitation supprimée'));
		return redirect()->route('club.members', ['club' => $club]);
	}
}
