<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id',
		'parent_id',
		'path',
	];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['last_revision'];

    /**
     * The site the page belongs to.
     */
    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    /**
     * The parent page.
     */
    public function parent()
    {
        return $this->belongsTo('App\Page');
    }

    /**
     * The pages linked to this page.
     */
    public function children()
    {
        return $this->hasMany('App\Page', 'parent_id');
    }

    /**
     * The revisions for this page.
     */
    public function revisions()
    {
        return $this->hasMany('App\PageRevision');
    }

    /**
     * The pages linked to this page.
     */
    public function last_revision()
    {
        return $this->hasOne('App\PageRevision')->latest();
	}

	public function getIsHomePageAttribute()
	{
		return $this->attributes['path'] === '/';
	}

	public function getIsError404PageAttribute()
	{
		return $this->attributes['path'] === '/404';
	}
}
