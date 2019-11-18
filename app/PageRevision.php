<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageRevision extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'page_id',
		'author_id',
		'title',
		'subtitle',
		'content',
	];

	/**
	 * The page this revision applies to.
	 */
	public function page()
	{
		return $this->belongsTo('App\Page');
	}

	/**
	 * The user who created this revision.
	 */
	public function author()
	{
		return $this->belongsTo('App\User', 'author');
	}
}
