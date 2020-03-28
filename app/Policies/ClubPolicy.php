<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

use App\User;
use App\Club;
use App\ClubUser;

class ClubPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any clubs.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can view the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function view(User $user, Club $club)
	{
		//
	}

	/**
	 * Determine whether the user can create clubs.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can invite a member to the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function invite_member(User $user, Club $club)
	{
		return $club->loadCount('members')->members_count < 10 && ClubUser::where('user_id', $user->id)->where('club_id', $club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can create a new site for the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function create_site(User $user, Club $club)
	{
		return $club->loadCount('sites')->sites_count < 2 && ClubUser::where('user_id', $user->id)->where('club_id', $club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can add a new sport for the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function add_sport(User $user, Club $club)
	{
		return $club->loadCount('sports')->sports_count < 5 && ClubUser::where('user_id', $user->id)->where('club_id', $club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can update the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function update(User $user, Club &$club)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can delete the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function delete(User $user, Club $club)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can restore the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function restore(User $user, Club $club)
	{
		return ClubUser::where('user_id', $user->id)->where('club_id', $club->id)->where('is_owner', true)->count();
	}

	/**
	 * Determine whether the user can permanently delete the club.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Club  $club
	 * @return mixed
	 */
	public function forceDelete(User $user, Club $club)
	{
		//
	}
}
