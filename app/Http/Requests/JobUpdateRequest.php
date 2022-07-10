<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends BaseRequest
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
            'title' => ['required', 'max:255', 'string'],
            'code' => [
                'nullable',
                'unique:jobs,code,' . $this->id,
                'max:255',
                'string',
            ],
            'country_id' => ['nullable', 'numeric', 'exists:countries,id'],
            'region_id' => ['nullable', 'numeric', 'exists:regions,id'],
            'city_id' => ['nullable', 'numeric', 'exists:cities,id'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'location' => ['required_without:is_remote,'.true, 'max:255', 'string'],
            'is_remote' => ['nullable', 'boolean'],
            'description' => ['required', 'max:255', 'string'],
            'requirements' => ['required', 'max:255', 'string'],
            'benefit' => ['nullable', 'max:255', 'string'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'industry_id' => ['nullable', 'numeric', 'exists:industries,id'],
            'job_function_id' => [
                'nullable',
                'numeric',
                'exists:job_functions,id',
            ],
            'employment_type_id' => [
                'nullable',
                'numeric',
                'exists:employment_types,id',
            ],
            'experience_level_id' => [
                'nullable',
                'numeric',
                'exists:experience_levels,id',
            ],
            'education_level_id' => [
                'nullable',
                'numeric',
                'exists:education_levels,id',
            ],
            'keywords' => ['nullable', 'max:255', 'string'],
            'salary_min' => ['required_with:salary_max', 'numeric'],
            'salary_max' => ['required_with:salary_min', 'numeric'],
            'salary_currency_id' => [
                'required_with:salary_min',
                'numeric',
                'exists:currencies,id',
            ],
            'head_count' => ['nullable', 'max:255'],
            'deadline' => ['required', 'date'],
        ];
    }
}
