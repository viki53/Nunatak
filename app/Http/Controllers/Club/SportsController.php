<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;
use App\Sport;

class SportsController extends Controller
{
	/**
	 * Show the club's sports list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Club $club, Request $request)
	{
		$club->load('sports');
		$sports = Sport::orderBy('name', 'ASC')->get();

		return view('club.sports', [
			'club' => $club,
			'sports' => $sports,
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

	/**
	 * Remove a sport from the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function remove(Club $club, Sport $sport, Request $request)
	{
		$club->sports()->detach($sport);

		$club->save();

		$request->session()->flash('status', __('Sport retiré'));
		return redirect()->route('club.sports', ['club' => $club]);
	}
}
