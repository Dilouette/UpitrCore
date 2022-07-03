<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AssesmentQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AssesmentQuestionOption;
use App\Http\Resources\AssesmentQuestionResource;
use App\Http\Resources\AssesmentQuestionCollection;
use App\Http\Requests\AssesmentQuestionStoreRequest;
use App\Http\Requests\AssesmentQuestionUpdateRequest;
use App\Http\Requests\AssesmentQuestionStoreBulkRequest;

class AssesmentQuestionController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = AssesmentQuestion::query()
                ->orderby('id', 'asc');

            $query->when($request->filled('assessment'), function ($q) use($request){
                return $q->where("assesment_id", $request->assessment);
            });

            $jobs = null;
            if ($page_size =! '*') {
                $jobs = $query->paginate($page_size);
            } else {
                $jobs = $query->get();
            }            
            
            return $this->success($jobs);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }    
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function bulk(AssesmentQuestionStoreBulkRequest $request)
    {
        try {
            $validated = $request->validated();
            DB::beginTransaction();
            Log::info($validated['questions']);
            foreach ($validated['questions'] as $question) {
                $q = AssesmentQuestion::create([
                    'assesment_id' => $validated['assesment_id'],
                    'question_type_id' => $question['question_type_id'],
                    'question' => $question['question'],
                ]);
                foreach ($question['options'] as $option) {
                    Log::info($option);
                    AssesmentQuestionOption::create([
                        'assesment_question_id' => $q->id,
                        'value' => $option['value'],
                        'is_answer' => $option['is_answer'],
                    ]);
                }
            }
            DB::commit();
            return $this->success();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->server_error($th);
        }        
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentQuestionStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            DB::beginTransaction();
            $q = AssesmentQuestion::create([
                'assesment_id' => $validated['assesment_id'],
                'question_type_id' => $validated['question_type_id'],
                'question' => $validated['question'],
            ]);
            foreach ($validated['options'] as $option) {
                AssesmentQuestionOption::create([
                    'assesment_question_id' => $q->id,
                    'value' => $option['value'],
                    'is_answer' => $option['is_answer'],
                ]);
            }
            $q->load(
                'questionType',
                'assesmentQuestionOptions', 
            );
            DB::commit();
            return $this->success($q);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $question  = AssesmentQuestion::find($id);
            if (!$question) {
                return $this->not_found();
            }

            $question->load(
                'questionType',
                'assesmentQuestionOptions', 
            );

            return $this->success($question);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $question  = AssesmentQuestion::find($id);
            if (!$question) {
                return $this->not_found();
            }

            $options = AssesmentQuestionOption::where('assesment_question_id', $question->id)->get();

            $options->each(function($option) {
                $option->delete();
            });

            $question->delete();

            return $this->success();
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
