<?php

namespace App\Http\Middleware;

use Closure;
use App\Site;

class LoadSite
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$site = Site::where([
			'domain' => $request->getHost(),
		])->first();

		if(empty($site)) {
			return redirect('http'.($request->secure() ? 's' : '').'://'.config('nunatak.root_domain'));
		}

		$site->load(['club']);

		$request->site = $site;

		return $next($request);
	}
}
