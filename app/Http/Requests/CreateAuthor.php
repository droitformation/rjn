<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthor extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if (\Auth::check())
        {
            return true;
        }

        return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'first_name' => 'required',
            'last_name'  => 'required'
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
            'first_name.required' => 'Le prénom parent est requis',
            'last_name.required'  => 'Le nom est requis'
        ];
    }

}
