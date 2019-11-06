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

    /**
     * The club the sport is affected to.
     */
    public function club()
    {
        return $this->belongsTo('App\Club');
    }

    /**
     * The sport the club offers.
     */
    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }
}
