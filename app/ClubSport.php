<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClubSport extends Pivot
{
	public $incrementing = true;

	protected $table = 'club_sport';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'club_id',
		'sport_id',
	];
}
