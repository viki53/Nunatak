<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateClubInfo as UpdateClubInfoRequest;

class ClubController extends Controller
{
	/**
	 * Show the club edit form.
	 *
	 * @param  \App\Club  $club
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index($id)
	{
		$club = \App\Club::findOrFail($id);

		return view('club.edit', [
			'club' => $club,
		]);
	}

	/**
	 * Update the club's information.
	 *
	 * @param  \App\Club  $club
	 * @param  Request  $request
	 * @return Response
	 */
	public function update($id, UpdateClubInfoRequest $request)
	{
		$club = \App\Club::findOrFail($id);

		$validatedData = $request->validated();

		$club->name = $validatedData['name'];
		$club->address = $validatedData['address'];
		$club->city = $validatedData['city'];
		$club->country = $validatedData['country'];
		$club->registration_number = $validatedData['registration_number'];
		$club->category_id = $validatedData['category_id'];

		$club->save();

		$request->session()->flash('status', __('Association mise à jour'));
		return redirect()->route('dashboard');
	}
}
