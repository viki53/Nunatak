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
		'category',
	];

    /**
     * The sites related to the club.
     */
    public function sites()
    {
        return $this->hasMany('App\Site');
	}

    /**
     * The users registered in the club.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->using('App\ClubUser')->withPivot([
			'created_at',
			'updated_at',
			'is_owner'
		]);
    }
}
