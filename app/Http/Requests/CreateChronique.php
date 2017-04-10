<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChronique extends FormRequest {

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
            'titre'        => 'required',
            'volume_id'    => 'required',
            'domain_id'    => 'required',
            'page'         => 'required',
            'pub_date'     => 'required',
            'faits'        => 'required'
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
            'faits.required'       => 'Le contenu est requis',
            'pub_date.required'    => 'La date de publication est requise',
            'titre.required'       => 'Le titre est requis',
            'domain_id.required'   => 'Le domaine est requis',
            'volume_id.required'   => 'Le volume est requis'
        ];
    }


}
