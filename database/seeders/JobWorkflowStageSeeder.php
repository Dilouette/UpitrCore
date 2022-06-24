<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobWorkflowStage;

class JobWorkflowStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobWorkflowStage::factory()
            ->count(5)
            ->create();
    }
}
