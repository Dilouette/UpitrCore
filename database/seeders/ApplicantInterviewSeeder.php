<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\Interview;
use Illuminate\Database\Seeder;
use App\Models\ApplicantInterview;

class ApplicantInterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed single applicant with interviews
        $applicant = Applicant::find(1);
        $interview = Interview::where('job_id', $applicant->job_id)->first();

        $start_time = Carbon::now();
        $end_time = $start_time->addMinutes(60);

        for ($i=1; $i < 6; $i++) { 
            ApplicantInterview::factory()
            ->create([
                'start_time' => $start_time,
                'end_time' => $end_time,
                'applicant_id' => $applicant->id,
                'interview_id' => $interview->id,
                'created_by' => $i,
            ]);
        }      
            
    }
}
