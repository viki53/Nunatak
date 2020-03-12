<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

use App\Page;

class UpdatePageRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$page = $this->route()->parameter('page');

		return [
			'title' => ['required', 'string', 'max:255'],
			'subtitle' => ['required', 'string', 'max:255'],
			'path' => ['required', 'string', Rule::unique('pages')->ignore($page->id)->where(function (Builder $query) {
				return $query->where('site_id', $this->route()->parameter('site')->id);
			})],
			'content' => ['required', 'string'],
		];
	}
}
