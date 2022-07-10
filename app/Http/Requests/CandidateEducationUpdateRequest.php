<?php

namespace App\Http\Requests;

use BenSampo\Enum\Rules\EnumValue;
use App\Enums\DegreeClassification;
use Illuminate\Foundation\Http\FormRequest;

class CandidateEducationUpdateRequest extends FormRequest
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
            'institution' => ['required', 'max:255', 'string'],
            'field' => ['required', 'max:255', 'string'],
            'degree' => ['required', 'max:255', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'candidate_id' => ['required', 'exists:candidates,id'],
            'degree_classification_id' => ['required', 'integer', new EnumValue(DegreeClassification::class)],
        ];
    }
}
