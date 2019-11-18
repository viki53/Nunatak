<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Site;
use App\Page;
use App\PageRevision;

class PagesController extends Controller
{
	/**
	 * Display the site's pages list
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Site $site, Request $request)
	{
		$site->load(['club', 'pages.last_revision']);

		return view('club.pages.list', [
			'protocol' => 'http'.($request->secure() ? 's' : ''),
			'site' => $site,
		]);
	}

	/**
	 * Add a page to the site.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function add(Site $site, CreatePageRequest $request)
	{
		$validatedData = $request->validated();
		$site->load(['club']);

		$page = $site->pages()->create([
			'path' => $validatedData['path'],
		]);

		$page->revisions()->create([
			'title' => $validatedData['title'],
			'subtitle' => '',
			'content' => 'Cette page est vide. Pensez à la remplir !',
		]);

		$request->session()->flash('status', __('Page créée'));
		return redirect()->route('site.pages.edit', ['site' => $site, 'page' => $page]);
	}

	/**
	 * Display a page's edition form
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function edit(Site $site, Page $page, Request $request)
	{
		$site->load(['club']);
		$page->load(['last_revision']);

		return view('club.pages.edit', [
			'protocol' => 'http'.($request->secure() ? 's' : ''),
			'site' => $site,
			'page' => $page,
		]);
	}

	/**
	 * Update a site's page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function update(Site $site, Page $page, UpdatePageRequest $request)
	{
		$validatedData = $request->validated();
		$site->load(['club']);

		$page->revisions()->create([
			'title' => $validatedData['title'],
			'subtitle' => $validatedData['subtitle'],
			'content' => $validatedData['content'],
		]);

		$request->session()->flash('status', __('Page mise à jour'));
		return redirect()->route('site.pages', ['site' => $site]);
	}

	/**
	 * Remove a site from the club's list.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function remove(Site $site, Page $page, Request $request)
	{
		if($page->path === '/') {
			$request->session()->flash('status', __('Page protégée, vous ne pouvez pas la supprimer'));
			return redirect()->route('site.pages', ['site' => $site]);
		}
		$page->delete();

		$request->session()->flash('status', __('Page supprimée'));
		return redirect()->route('site.pages', ['site' => $site]);
	}
}
