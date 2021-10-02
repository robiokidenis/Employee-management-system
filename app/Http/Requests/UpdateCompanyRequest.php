<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string|',
            'email' => 'required|email',
            'website' => 'nullable|url',
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
            'name' => 'company name'
        ];
    }
}
