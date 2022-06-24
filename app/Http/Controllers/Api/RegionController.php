<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use App\Http\Resources\RegionCollection;
use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;

class RegionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Region::class);

        $search = $request->get('search', '');

        $regions = Region::search($search)
            ->latest()
            ->paginate();

        return new RegionCollection($regions);
    }

    /**
     * @param \App\Http\Requests\RegionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionStoreRequest $request)
    {
        $this->authorize('create', Region::class);

        $validated = $request->validated();

        $region = Region::create($validated);

        return new RegionResource($region);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Region $region)
    {
        $this->authorize('view', $region);

        return new RegionResource($region);
    }

    /**
     * @param \App\Http\Requests\RegionUpdateRequest $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(RegionUpdateRequest $request, Region $region)
    {
        $this->authorize('update', $region);

        $validated = $request->validated();

        $region->update($validated);

        return new RegionResource($region);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Region $region)
    {
        $this->authorize('delete', $region);

        $region->delete();

        return response()->noContent();
    }
}
