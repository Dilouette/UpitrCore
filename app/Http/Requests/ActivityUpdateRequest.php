<?php

namespace App\Http\Requests;

use App\Enums\ActivityTypes;
use App\Enums\ActivityStatuses;
use App\Enums\ImportanceLevels;
use App\Enums\ActivityRelations;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ActivityUpdateRequest extends BaseRequest
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
            'activity_type_id' => ['required', 'integer', new EnumValue(ActivityTypes::class)],
            'title' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'location' => ['nullable', 'max:255', 'string'],
            'meeting_url' => ['nullable', 'max:255', 'string'],
            'related_to_id' => ['required', 'integer', new EnumValue(ActivityRelations::class)],
            'importance_id' => ['required', 'integer', new EnumValue(ImportanceLevels::class)],
            'status_id' => ['required', 'integer', new EnumValue(ActivityStatuses::class)],
            'description' => ['required', 'max:255', 'string'],
            'applicant_id' => ['nullable', 'exists:applicants,id'],
            'job_id' => ['nullable', 'exists:jobs,id'],
            'assignees.*' => ['distinct', 'exists:users,id'],
        ];
    }
}
