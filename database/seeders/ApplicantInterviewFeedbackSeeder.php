<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantInterviewFeedback;

class ApplicantInterviewFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantInterviewFeedback::factory()
            ->count(5)
            ->create();
    }
}
