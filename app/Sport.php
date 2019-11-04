<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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


    /**
     * Get the sport's slug to build URLs.
     *
     * @param  string  $value
     * @return string
     */
    public function getSlugAttribute()
    {
        return $this->id.'-'.Str::slug($this->name);
    }
}
