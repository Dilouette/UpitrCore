<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Activity;
use App\Models\JobApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ServiceController;

class DashboardController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Get Active Vacancy Count
            $active_vacancies = Job::where('is_published', false)
            ->where('deadline', '>=', Carbon::now())->count();  
            
            // Get Active Candidate Count
            $active_candidates = JobApplicant::whereHas('job', function ($q) {
                return $q->where('is_published', false)
                ->where('deadline', '>=', Carbon::now());
            })->count();  

            // Get Upcoming Activity Count
            $upcoming_activities = Activity::where(function($q){
                return $q->where('created_by', Auth::user()->id)
                ->orWhereHas('assignees', function ($q) {
                    $q->where('user_id', Auth::user()->id);
                });
            })
            ->where('end', '>=', Carbon::now())->count();  

            // Most Recent Vacancies
            $vacancies = Job::latest()->take(5)->get();

            // Most Recent Candidates
            $candidates = JobApplicant::latest()->take(5)->get();

            // Most Recent Activities
            $activities = Activity::latest()->take(5)->get();
           
            $response=[
                'active_vacancies' => $active_vacancies,
                'active_candidates' => $active_candidates,
                'upcoming_activities' => $upcoming_activities,
                'vacancies' => $vacancies,
                'candidates' => $candidates,
                'activities' => $activities
            ];

            return $this->success($response);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }
}
