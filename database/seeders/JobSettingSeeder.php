<?php

namespace Database\Seeders;


use App\Models\Job;
use App\Models\JobSetting;
use Illuminate\Database\Seeder;

class JobSettingSeeder extends Seeder
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
            JobSetting::factory()
            ->create([
                'job_id' => $job->id,
            ]);
        }        
    }
}
