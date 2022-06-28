<?php

namespace Database\Seeders;

use App\Models\JobApplicant;
use Illuminate\Database\Seeder;
use App\Models\ApplicantEducation;

class ApplicantEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicants = JobApplicant::all();
        foreach ($applicants as $i => $applicant) {
            ApplicantEducation::factory()
            ->count(5)
            ->create([
                'job_applicant_id' => $applicant->id,
            ]);
        }
    }
}
