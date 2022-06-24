<?php

namespace App\Http\Controllers\Api;

use App\Models\Industry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\IndustryCollection;
use App\Http\Requests\IndustryStoreRequest;
use App\Http\Requests\IndustryUpdateRequest;

class IndustryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Industry::class);

        $search = $request->get('search', '');

        $industries = Industry::search($search)
            ->latest()
            ->paginate();

        return new IndustryCollection($industries);
    }

    /**
     * @param \App\Http\Requests\IndustryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndustryStoreRequest $request)
    {
        $this->authorize('create', Industry::class);

        $validated = $request->validated();

        $industry = Industry::create($validated);

        return new IndustryResource($industry);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Industry $industry
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Industry $industry)
    {
        $this->authorize('view', $industry);

        return new IndustryResource($industry);
    }

    /**
     * @param \App\Http\Requests\IndustryUpdateRequest $request
     * @param \App\Models\Industry $industry
     * @return \Illuminate\Http\Response
     */
    public function update(IndustryUpdateRequest $request, Industry $industry)
    {
        $this->authorize('update', $industry);

        $validated = $request->validated();

        $industry->update($validated);

        return new IndustryResource($industry);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Industry $industry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Industry $industry)
    {
        $this->authorize('delete', $industry);

        $industry->delete();

        return response()->noContent();
    }
}
