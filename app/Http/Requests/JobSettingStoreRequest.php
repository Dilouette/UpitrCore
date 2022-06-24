<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobSettingStoreRequest extends FormRequest
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
            'job_id' => ['required', 'exists:jobs,id'],
            'firstname' => ['required', 'in:mandatory'],
            'lastname' => ['required', 'in:mandatory'],
            'email' => ['required', 'in:mandatory'],
            'phone' => ['required', 'in:mandatory,optional,off'],
            'heading' => ['required', 'in:mandatory,optional,off'],
            'address' => ['required', 'in:mandatory,optional,off'],
            'photo' => ['required', 'in:mandatory,optional,off'],
            'education' => ['required', 'in:optional,off'],
            'experience' => ['required', 'in:optional,off'],
            'summary' => ['required', 'in:mandatory,optional,off'],
            'resume' => ['required', 'in:mandatory,optional,off'],
            'cover_letter' => ['required', 'in:mandatory,optional,off'],
            'cv' => ['required', 'in:mandatory,optional,off'],
        ];
    }
}
