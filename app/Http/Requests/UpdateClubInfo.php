<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClubInfo extends FormRequest
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
			'name' => ['required', 'string', 'max:255'],
			'address' => ['required'],
			'city' => ['required', 'string'],
			'country' => ['required', 'string', 'length:2'],
			'registration_number' => ['required', 'string'],
			'category_id' => ['required', 'exists:club_categories:id'],
		];
    }
}
