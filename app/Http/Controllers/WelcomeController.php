<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Splashscreen;

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

		return view('welcome', ['splashscreen' => $splashscreen]);
	}
}
