<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSiteRequest;
use App\Club;
use App\Site;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
			'protocol' => 'http'.($request->secure() ? 's' : ''),
			'club' => $club,
		]);
	}

	/**
	 * Add a site to the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function add(Club $club, CreateSiteRequest $request)
	{
		$validatedData = $request->validated();

		$site = $club->sites()->create([
			'title' => $validatedData['title'],
			'domain' => $validatedData['domain'],
		]);

		$home_page = $site->pages()->create([
			'path' => '/',
		]);

		$home_page->revisions()->create([
			'title' => 'Bienvenue',
			'subtitle' => 'Ceci est votre page d\'accueil',
			'content' => '<p>Vous pouvez modifier ce texte à volonté, l\'historique des modifications sera enregistré.</p><p>Vous pouvez même sauter des lignes ou mettre des mots en <strong>gras</strong> ou en <em>italique</em> !</<p>',
		]);

		$request->session()->flash('status', __('Site créé'));
		return redirect()->route('site.pages', ['site' => $site]);
	}

	/**
	 * Remove a site from the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function remove(Club $club, Site $site, Request $request)
	{
		$site->domain = $site->domain.'.deleted_'.Carbon::now()->format('Y-m-d').'_'.Carbon::now()->format('H-i-s');
		$site->save();
		$site->delete();

		$request->session()->flash('status', __('Site retiré'));
		return redirect()->route('club.sites', ['club' => $club]);
	}
}
