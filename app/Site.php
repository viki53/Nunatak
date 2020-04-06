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
     * The users registered to the site.
     */
    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Club');
    }

    /**
     * The site's pages.
     */
    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    /**
     * The site's home page.
     */
    public function home_page()
    {
        return $this->hasOne('App\Page')->where('path', '/')->latest();
	}

    /**
     * The site's 404 error page.
     */
    public function error404_page()
    {
        return $this->hasOne('App\Page')->where('path', '/404')->latest();
    }
}
