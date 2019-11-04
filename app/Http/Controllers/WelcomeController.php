<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Splashscreen;
use App\Sport;

class WelcomeController extends Controller
{
	/**
	 * Show the application home page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$splashscreen = Splashscreen::all()->random(1)->first();
		$sports = Sport::has('clubs')->get();

		return view('welcome', [
			'splashscreen' => $splashscreen,
			'sports' => $sports
		]);
	}
}
