<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClubUser extends Pivot
{
	public $incrementing = true;

	protected $table = 'club_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'club_id',
		'user_id',
		'user_email',
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

    /**
     * The club the user is registered in.
     */
    public function club()
    {
        return $this->belongsTo('App\Club');
    }

    /**
     * The registered user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
