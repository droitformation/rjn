<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCritique extends FormRequest {

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
            'titre'     => 'required',
            'author_id' => 'required',
            'type'      => 'required',
            'item_id'   => 'required'
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
            'author_id.required' => 'L\'auteur est requis',
            'type.required'      => 'Le type de contenu est requis',
            'item_id.required'   => 'Un contenu est requis'
        ];
    }

}
