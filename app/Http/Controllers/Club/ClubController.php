<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Club;
use App\Sport;
use App\Http\Requests\UpdateClubRequest;

class ClubController extends Controller
{
	/**
	 * Show the club edit form.
	 *
	 * @param  \App\Club  $club
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Club $club)
	{
		$club->load('sports');
		$sports = Sport::orderBy('name', 'ASC')->whereNotIn('id', $club->sports()->allRelatedIds()->toArray())->get();

		return view('dashboard.club.edit', [
			'club' => $club,
			'sports' => $sports,
		]);
	}

	/**
	 * Update the club's information.
	 *
	 * @param  \App\Club  $club
	 * @param  Request  $request
	 * @return Response
	 */
	public function update(Club $club, UpdateClubRequest $request)
	{
		$validatedData = $request->validated();

		$club->name = $validatedData['name'];
		$club->address = $validatedData['address'];
		$club->city = $validatedData['city'];
		$club->country = $validatedData['country'];
		$club->registration_number = $validatedData['registration_number'];

		$club->save();

		$request->session()->flash('status', __('Association mise à jour'));
		$request->session()->flash('status-type', 'info');
		return redirect()->route('dashboard');
	}
}
