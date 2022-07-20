<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class SignupRequest extends BaseRequest
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
            'email' => ['required', 'unique:candidates,email', 'email'],
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'middlename' => ['required', 'max:255', 'string'],
            'gender_id' => ['required', 'max:1', 'min:0', 'integer'],
            'password' => ['required', 'min:8', 'string', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
        ];
    }
}
