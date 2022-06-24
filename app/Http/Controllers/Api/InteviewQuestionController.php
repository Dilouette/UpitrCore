<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\InteviewQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\InteviewQuestionResource;
use App\Http\Resources\InteviewQuestionCollection;
use App\Http\Requests\InteviewQuestionStoreRequest;
use App\Http\Requests\InteviewQuestionUpdateRequest;

class InteviewQuestionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', InteviewQuestion::class);

        $search = $request->get('search', '');

        $inteviewQuestions = InteviewQuestion::search($search)
            ->latest()
            ->paginate();

        return new InteviewQuestionCollection($inteviewQuestions);
    }

    /**
     * @param \App\Http\Requests\InteviewQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InteviewQuestionStoreRequest $request)
    {
        $this->authorize('create', InteviewQuestion::class);

        $validated = $request->validated();

        $inteviewQuestion = InteviewQuestion::create($validated);

        return new InteviewQuestionResource($inteviewQuestion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InteviewQuestion $inteviewQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, InteviewQuestion $inteviewQuestion)
    {
        $this->authorize('view', $inteviewQuestion);

        return new InteviewQuestionResource($inteviewQuestion);
    }

    /**
     * @param \App\Http\Requests\InteviewQuestionUpdateRequest $request
     * @param \App\Models\InteviewQuestion $inteviewQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        InteviewQuestionUpdateRequest $request,
        InteviewQuestion $inteviewQuestion
    ) {
        $this->authorize('update', $inteviewQuestion);

        $validated = $request->validated();

        $inteviewQuestion->update($validated);

        return new InteviewQuestionResource($inteviewQuestion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InteviewQuestion $inteviewQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        InteviewQuestion $inteviewQuestion
    ) {
        $this->authorize('delete', $inteviewQuestion);

        $inteviewQuestion->delete();

        return response()->noContent();
    }
}
