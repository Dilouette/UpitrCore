<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Interview;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
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
            Interview::factory()
            ->create([
                'title' => $job->title. ' Interview',
                'job_id' => $job->id,
            ]);
        }
    }
}
