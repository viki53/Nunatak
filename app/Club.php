<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'address',
		'city',
		'country',
		'registration_number',
	];

    /**
     * The sites related to the club.
     */
    public function sites()
    {
        return $this->hasMany('App\Site');
	}

    /**
     * The sport the club supports.
     */
    public function sports()
    {
        return $this->belongsToMany('App\Sport')->using('App\ClubSport')->withPivot([
			'created_at',
			'updated_at',
		]);
    }

    /**
     * The users registered in the club.
     */
    public function members()
    {
        return $this->belongsToMany('App\User')->using('App\ClubUser')->withPivot([
			'created_at',
			'updated_at',
			'is_owner',
		]);
    }
}
