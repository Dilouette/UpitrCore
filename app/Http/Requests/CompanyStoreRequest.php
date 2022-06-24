<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'unique:companies,name',
                'max:255',
                'string',
            ],
            'email' => ['required', 'unique:companies,email', 'email'],
            'website' => ['nullable', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'bio' => ['nullable', 'max:255', 'string'],
            'logo' => ['nullable', 'max:255', 'string'],
            'hiring_thumbnail' => ['nullable', 'max:255', 'string'],
        ];
    }
}
