<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\JobApplicantResource;
use App\Http\Resources\JobApplicantCollection;
use App\Http\Requests\JobApplicantStoreRequest;
use App\Http\Requests\JobApplicantUpdateRequest;

class JobApplicantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobApplicant::class);

        $search = $request->get('search', '');

        $jobApplicants = JobApplicant::search($search)
            ->latest()
            ->paginate();

        return new JobApplicantCollection($jobApplicants);
    }

    /**
     * @param \App\Http\Requests\JobApplicantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobApplicantStoreRequest $request)
    {
        $this->authorize('create', JobApplicant::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $jobApplicant = JobApplicant::create($validated);

        return new JobApplicantResource($jobApplicant);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('view', $jobApplicant);

        return new JobApplicantResource($jobApplicant);
    }

    /**
     * @param \App\Http\Requests\JobApplicantUpdateRequest $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobApplicantUpdateRequest $request,
        JobApplicant $jobApplicant
    ) {
        $this->authorize('update', $jobApplicant);

        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($jobApplicant->photo) {
                Storage::delete($jobApplicant->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $jobApplicant->update($validated);

        return new JobApplicantResource($jobApplicant);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('delete', $jobApplicant);

        if ($jobApplicant->photo) {
            Storage::delete($jobApplicant->photo);
        }

        $jobApplicant->delete();

        return response()->noContent();
    }
}
