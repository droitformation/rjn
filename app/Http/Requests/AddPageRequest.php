<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPageRequest extends FormRequest {

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
            'volume_id' => 'required',
            'page'      => 'required',
            'alinea'    => 'required_without_all:chiffre,lettre',
            'chiffre'   => 'required_without_all:alinea,lettre',
            'lettre'    => 'required_without_all:alinea,chiffre'
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
            'volume_id.required'  => 'Veuillez indiquer le volume',
            'page.required'       => 'Veuillez indiquer la pagep',
            'alinea.required_without_all'  => 'Veuillez indiquer au moins un champ',
            'chiffre.required_without_all' => 'Veuillez indiquer au moins un champ',
            'lettre.required_without_all'  => 'Veuillez indiquer au moins un champ',
        ];
    }

}
