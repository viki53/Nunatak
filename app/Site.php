<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'domain',
	];

    /**
     * The users registered in the club.
     */
    public function club()
    {
        return $this->belongsTo('App\Club');
    }

    /**
     * The users registered to the ssite.
     */
    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Club');
    }
}
