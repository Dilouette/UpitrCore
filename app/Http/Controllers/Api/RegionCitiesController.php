<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;

class RegionCitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Region $region)
    {
        $this->authorize('view', $region);

        $search = $request->get('search', '');

        $cities = $region
            ->cities()
            ->search($search)
            ->latest()
            ->paginate();

        return new CityCollection($cities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Region $region)
    {
        $this->authorize('create', City::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $city = $region->cities()->create($validated);

        return new CityResource($city);
    }
}
