<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMatiere extends FormRequest {

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
            'title' => 'required|unique:matieres,title'
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
            'title.required' => 'Le titre est requis',
            'title.unique'   => 'Cette matière existe déjà'
        ];
    }


}
