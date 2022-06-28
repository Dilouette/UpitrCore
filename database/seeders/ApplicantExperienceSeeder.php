<?php

namespace Database\Seeders;

use App\Models\JobApplicant;
use Illuminate\Database\Seeder;
use App\Models\ApplicantExperience;

class ApplicantExperienceSeeder extends Seeder
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
            ApplicantExperience::factory()
            ->count(5)
            ->create([
                'job_applicant_id' => $applicant->id,
            ]);
        }        
    }
}
