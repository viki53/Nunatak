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

		$path = $request->path();
		if (substr($path, 0 ,1) !== '/') {
			$path = '/'.$path;
		}

		$page = Page::where([
			'site_id' => $site->id,
			'path' => $path,
		])->with(['last_revision'])->first();

		if (empty($page)) {
			return abort(404);
		}

		return view('site.page', [
			'site' => $site,
			'page' => $page,
		]);
	}
}
