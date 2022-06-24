<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BenefitTemplate;
use App\Http\Controllers\Controller;
use App\Http\Resources\BenefitTemplateResource;
use App\Http\Resources\BenefitTemplateCollection;
use App\Http\Requests\BenefitTemplateStoreRequest;
use App\Http\Requests\BenefitTemplateUpdateRequest;

class BenefitTemplateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BenefitTemplate::class);

        $search = $request->get('search', '');

        $benefitTemplates = BenefitTemplate::search($search)
            ->latest()
            ->paginate();

        return new BenefitTemplateCollection($benefitTemplates);
    }

    /**
     * @param \App\Http\Requests\BenefitTemplateStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BenefitTemplateStoreRequest $request)
    {
        $this->authorize('create', BenefitTemplate::class);

        $validated = $request->validated();

        $benefitTemplate = BenefitTemplate::create($validated);

        return new BenefitTemplateResource($benefitTemplate);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BenefitTemplate $benefitTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BenefitTemplate $benefitTemplate)
    {
        $this->authorize('view', $benefitTemplate);

        return new BenefitTemplateResource($benefitTemplate);
    }

    /**
     * @param \App\Http\Requests\BenefitTemplateUpdateRequest $request
     * @param \App\Models\BenefitTemplate $benefitTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(
        BenefitTemplateUpdateRequest $request,
        BenefitTemplate $benefitTemplate
    ) {
        $this->authorize('update', $benefitTemplate);

        $validated = $request->validated();

        $benefitTemplate->update($validated);

        return new BenefitTemplateResource($benefitTemplate);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BenefitTemplate $benefitTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BenefitTemplate $benefitTemplate)
    {
        $this->authorize('delete', $benefitTemplate);

        $benefitTemplate->delete();

        return response()->noContent();
    }
}
