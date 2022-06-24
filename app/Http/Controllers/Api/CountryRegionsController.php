<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use App\Http\Resources\RegionCollection;

class CountryRegionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Country $country)
    {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $regions = $country
            ->regions()
            ->search($search)
            ->latest()
            ->paginate();

        return new RegionCollection($regions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Country $country)
    {
        $this->authorize('create', Region::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $region = $country->regions()->create($validated);

        return new RegionResource($region);
    }
}
