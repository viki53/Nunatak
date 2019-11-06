<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;

class SitesController extends Controller
{
	/**
	 * Display the club's sites list
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Club $club, Request $request)
	{
		$club->load('sites');

		return view('club.sites', [
			'club' => $club,
		]);
	}

	/**
	 * Add a sport to the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function add(Club $club, Request $request)
	{
		$club->sports()->attach($request->input('sport_id'));

		$club->save();

		$request->session()->flash('status', __('Sport ajouté'));
		return redirect()->route('club.sports', ['club' => $club]);
	}
}
