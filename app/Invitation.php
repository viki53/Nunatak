<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'club_id',
		'user_id',
		'user_email',
		'user_name',
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
