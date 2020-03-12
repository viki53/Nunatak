<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class CreatePageRequest extends FormRequest
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
		return [
			'title' => ['required', 'string', 'max:255'],
			'path' => ['required', 'string', Rule::unique('pages')->where(function (Builder $query) {
				return $query->where('site_id', $this->route()->parameter('site')->id);
			})],
		];
	}
}
