<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClubUser extends Pivot
{
	public $incrementing = true;

	protected $table = 'clubs_users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'club_id',
		'user_id',
		'is_owner',
	];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_owner' => 'boolean',
    ];
}
