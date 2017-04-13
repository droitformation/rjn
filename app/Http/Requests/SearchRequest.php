<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest {

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
            'loi'     => 'required_without:article',
            'article' => 'required_without:loi'
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
            'loi.required_without'     => 'Sans article veuillez indiquer au moins une loi',
            'article.required_without' => 'Sans loi veuillez indiquer au moins un article',
        ];
    }

}
