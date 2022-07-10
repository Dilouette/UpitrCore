<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateStoreRequest extends BaseRequest
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
            'firstname' => ['required', 'max:128', 'string'],
            'middlename' => ['nullable', 'max:128', 'string'],
            'lastname' => ['required', 'max:128', 'string'],
            'email' => ['required', 'unique:candidates,email', 'email'],
            'dob' => ['required', 'date'],
            'gender_id' => ['required', 'min:0', 'max:1'],
            'phone' => ['nullable', 'max:64', 'string'],
            'headline' => ['nullable', 'max:256', 'string'],
            'country_id' => ['nullable', 'numeric', 'exists:countries,id'],
            'region_id' => ['nullable', 'numeric', 'exists:regions,id'],
            'city_id' => ['nullable', 'numeric', 'exists:cities,id'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:256', 'string'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg'],
            'summary' => ['nullable', 'max:512', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:10240'],
            'skills' => ['nullable', 'string'],
            'industry_id' => ['nullable', 'numeric', 'exists:industries,id'],
            'job_function_id' => ['nullable', 'numeric', 'exists:job_functions,id'],
        ];
    }
}
