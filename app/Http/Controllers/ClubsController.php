<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Sport;

class ClubsController extends Controller
{
	/**
	 * Show and search the clubs list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index($sportid = null, $sportname = null, Request $request)
	{
		$sport = null;
		if (!empty($sportid)) {
			$sport = Sport::find($sportid);
		}

		$query = Club::with(['sports']);

		if (!empty($sport)) {
			$query = $sport->clubs();
		}

		$clubs = $query->get();

		return view('dashboard.clubs', [
			'clubs' => $clubs,
			'sport' => $sport
		]);
	}
}
