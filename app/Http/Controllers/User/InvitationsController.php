<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;
use App\ClubPendingMember;

class InvitationsController extends Controller
{
	/**
	 * Show the user profile.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		$user = $request->user();
		$user->load('invitations');

		return view('user.invitations', [
			'user' => $user
		]);
	}

	/**
	 * Accept an invitation.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function accept(Request $request)
	{
		$invitation = ClubPendingMember::findOrFail($request->input('invitation_id'));

		$request->user()->clubs()->attach($invitation->club_id);
		$invitation->delete();

		$request->session()->flash('status', __('Invitation acceptée'));
		return redirect()->route('dashboard');
	}

	/**
	 * Reject an invitation.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function reject(Request $request)
	{
		$invitation = ClubPendingMember::findOrFail($request->input('invitation_id'));
		$invitation->delete();

		$request->session()->flash('status', __('Invitation supprimée'));
		return redirect()->route('user.invitations');
	}
}
