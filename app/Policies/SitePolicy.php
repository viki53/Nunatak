<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\ClubUser;
use App\Site;
use App\User;

class SitePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any sites.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can view the site.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Site  $site
	 * @return mixed
	 */
	public function view(User $user, Site $site)
	{
		//
	}

	/**
	 * Determine whether the user can create sites.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can create a page for the site.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Site  $site
	 * @return mixed
	 */
	public function create_page(User $user, Site $site)
	{
		return $site->loadCount('pages')->pages_count < 10 && ClubUser::where('user_id', $user->id)->where('club_id', $site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can update the site.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Site  $site
	 * @return mixed
	 */
	public function update(User $user, Site $site)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can delete the site.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Site  $site
	 * @return mixed
	 */
	public function delete(User $user, Site $site)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can restore the site.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Site  $site
	 * @return mixed
	 */
	public function restore(User $user, Site $site)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can permanently delete the site.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Site  $site
	 * @return mixed
	 */
	public function forceDelete(User $user, Site $site)
	{
		//
	}
}
