<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class EmailVerificationRequest extends BaseRequest
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
            'email' => ['required', 'email'],
            'token' => ['required', 'string'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => "Email address is required",
            'token.required' => "Verification token is required",
            'email.email' => "Email address must be well formed eg mail@domain.com",
        ];
    }
}
