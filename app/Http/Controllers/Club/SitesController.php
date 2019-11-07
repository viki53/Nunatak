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
	 * Add a site to the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function add(Club $club, Request $request)
	{
		$club->sites()->create([
			'name' => $request->input('name'),
			'domain' => $request->input('domain'),
		]);

		$request->session()->flash('status', __('Site créé'));
		return redirect()->route('club.sites', ['club' => $club]);
	}

	/**
	 * Remove a site from the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function remove(Club $club, Site $site, Request $request)
	{
		$club->sites()->detach($site);

		$club->save();

		$request->session()->flash('status', __('Site retiré'));
		return redirect()->route('club.sites', ['club' => $club]);
	}
}
