<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
	];

    /**
     * The clubs referencing the sport.
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Club')->using('App\ClubSport');
	}
}
