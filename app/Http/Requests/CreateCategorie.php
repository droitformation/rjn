<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategorie extends FormRequest {

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
            'domain_id' => 'required',
            'title'     => 'required'
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
            'domain_id.required' => 'Le domaine parent est requis',
            'title.required'     => 'Le titre est requis'
        ];
    }

}
