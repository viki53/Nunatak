<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;
use App\Site;

class WelcomeController extends Controller
{
	/**
	 * Show the application home page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		$site = $request->site;

		return view('site.welcome', [
			'site' => $site,
		]);
	}
}
