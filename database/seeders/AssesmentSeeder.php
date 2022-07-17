<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Assesment;
use Illuminate\Database\Seeder;

class AssesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = Job::all();
        foreach ($jobs as $i => $job) {
            Assesment::factory()
            ->create([
                'is_timed' => true,
                'duration' => 60,
                'questions_per_candidate' => 10,
                'pass_score' => 5,
                'job_id' => $job->id,
            ]);
        }
    }
}
