<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\ApplicantAssesment;

class CandidateAssessmentController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = ApplicantAssesment::query()
                ->where('applicant_id', $id)
                ->orderby('id', 'desc');

            $assesments = $query->paginate($page_size)
            ->load('assesment','assesment.job')->makeHidden(['assesment.job.user']);

            return $this->success($assesments);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }      
    }
}
