<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => ['required', 'unique:users,email', 'email'],
            'username' => ['required', 'max:255', 'string'],
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'department_id' => ['nullable', 'numeric', 'exists:departments,id'],
            'role_id' => ['required', 'numeric', 'exists:roles,id'],
            'designation_id' => [
                'nullable',
                'numeric',
                'exists:designations,id',
            ],
        ];
    }
}
