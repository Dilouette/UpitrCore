<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Applicant;

class CandidateApplicationController extends ServiceController
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

            $query = Applicant::query()
                ->where('candidate_id', $id)
                ->orderby('id', 'desc');

            $applications = $query->paginate($page_size)
            ->load('job');

            return $this->success($applications);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }      
    }
}
