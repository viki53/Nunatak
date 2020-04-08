<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;
use App\Sport;

class SportsController extends Controller
{
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
		$request->session()->flash('status-type', 'success');
		return redirect(route('club.edit', ['club' => $club]).'#club-sports-add');
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
		$request->session()->flash('status-type', 'warning');
		return redirect(route('club.edit', ['club' => $club]).'#club-sports-list');
	}
}
