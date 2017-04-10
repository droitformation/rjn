<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupe extends FormRequest {

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
            'titre'      => 'required',
            'domain_id'  => 'required',
            'volume_id'  => 'required'
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
            'titre.required'     => 'Le titre parent est requis',
            'domain_id.required' => 'Le domaine est requis',
            'volume_id.required' => 'Le volume est requis'
        ];
    }

}
