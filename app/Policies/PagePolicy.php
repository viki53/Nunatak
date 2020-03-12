<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\ClubUser;
use App\Page;
use App\User;

class PagePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any pages.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can view the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function view(User $user, Page $page)
	{
		//
	}

	/**
	 * Determine whether the user can create pages.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can update the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function update(User $user, Page $page)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $page->site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can delete the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function delete(User $user, Page $page)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $page->site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can restore the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function restore(User $user, Page $page)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $page->site->club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can permanently delete the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function forceDelete(User $user, Page $page)
	{
		//
	}
}
