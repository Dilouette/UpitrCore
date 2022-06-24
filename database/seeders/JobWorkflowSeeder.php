<?php

namespace Database\Seeders;

use App\Models\JobWorkflow;
use Illuminate\Database\Seeder;

class JobWorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobWorkflow::factory()
            ->count(5)
            ->create();
    }
}
