<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Site;
use App\Page;
use App\PageRevision;

class PageController extends Controller
{
	/**
	 * Show the application home page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		$site = $request->site;

		if (empty($site)) {
			return abort(404);
		}

		$path = $request->path();
		if (substr($path, 0 ,1) !== '/') {
			$path = '/'.$path;
		}

		$page = Page::where([
			'site_id' => $site->id,
			'path' => $path,
		])->with(['last_revision'])->first();

		// Page not found, see if website has a custom 404 page
		if (empty($page)) {
			$page = Page::where([
				'site_id' => $site->id,
				'path' => '/404',
			])->with(['last_revision'])->first();

			if (empty($page)) {
				// Custom 404 page not found, use default one
				return response()->view('site.error404', [
					'site' => $site,
				], 404);
			}
			else {
				// Show custom 404 page
				return response()->view('site.page', [
					'site' => $site,
					'page' => $page,
				], 404);
			}
		}

		return view('site.page', [
			'site' => $site,
			'page' => $page,
		]);
	}
}
