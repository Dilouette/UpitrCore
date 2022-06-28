<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobQuestion;
use Illuminate\Database\Seeder;

class JobQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = Job::all();
        foreach ($jobs as $key => $job) {
            JobQuestion::factory()
            ->count(5)
            ->create([
                'job_id' => $job->id,
                'job_question_type_id' => rand(1, 6),
            ]);
        }    
        
    }
}
