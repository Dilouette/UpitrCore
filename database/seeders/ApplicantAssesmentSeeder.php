<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\Assesment;
use Illuminate\Database\Seeder;
use App\Models\ApplicantAssesment;
use Tests\Feature\Api\AssesmentAssesmentQuestionsTest;

class ApplicantAssesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed single applicant with assessments
        $applicant = Applicant::find(1);
        $assesment = Assesment::where('job_id', $applicant->job_id)->first();

        $start_time = Carbon::now();
        $end_time = $start_time->addMinutes(60);

        for ($i=2; $i < 7; $i++) { 
            ApplicantAssesment::factory()
            ->create([
                'start_time' => $start_time,
                'end_time' => $end_time,
                'applicant_id' => $applicant->id,
                'assesment_id' => $assesment->id,
            ]);
        }
    }
}
