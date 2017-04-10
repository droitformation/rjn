<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArret extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
/*        if (\Auth::check())
        {
            return true;
        }*/

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
            'designation' => 'required',
            'volume_id'   => 'required',
            'domain_id'   => 'required',
            'page'        => 'required',
            'pub_date'    => 'required',
            'cotes'       => 'required'
		];
	}

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'designation.required' => 'La designation est requise',
            'cotes.required'       => 'La référence/cote est requise',
            'pub_date.required'    => 'La date de publication est requise'
        ];
    }

}
