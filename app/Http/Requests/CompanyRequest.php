<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|',
            'email' => 'required|email|unique:companies,email',
        ];
    }
    public function messages()
    {
        return array_merge(parent::messages(), [
            'email.unique' => ':attribute is taken.',
            'name.min' => ':attribute required.'
        ]);
    }
    public function attributes()
    {
        return [
            'email' => 'email address',
            'name'=>'company name'
        ];
    }
}
