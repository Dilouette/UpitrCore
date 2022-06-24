<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EmploymentType;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;

class EmploymentTypeJobsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EmploymentType $employmentType)
    {
        $this->authorize('view', $employmentType);

        $search = $request->get('search', '');

        $jobs = $employmentType
            ->jobs()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobCollection($jobs);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EmploymentType $employmentType)
    {
        $this->authorize('create', Job::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'code' => ['nullable', 'unique:jobs,code', 'max:255', 'string'],
            'country_id' => ['nullable', 'numeric', 'exists:countries,id'],
            'region_id' => ['nullable', 'numeric', 'exists:regions,id'],
            'city_id' => ['nullable', 'numeric', 'exists:cities,id'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'location' => ['nullable', 'max:255', 'string'],
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
            'salary_min' => ['nullable', 'numeric'],
            'salary_max' => ['nullable', 'numeric'],
            'salary_currency_id' => [
                'nullable',
                'numeric',
                'exists:currencies,id',
            ],
            'head_count' => ['nullable', 'max:255'],
            'created_by' => ['required', 'max:255'],
            'is_published' => ['required', 'boolean'],
            'deadline' => ['required', 'date'],
            'job_workflow_id' => ['required', 'exists:job_workflows,id'],
        ]);

        $job = $employmentType->jobs()->create($validated);

        return new JobResource($job);
    }
}
