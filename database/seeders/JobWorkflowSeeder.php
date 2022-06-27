<?php

namespace Database\Seeders;

use App\Models\JobWorkflow;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class JobWorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobWorkflow::create([
            "name" => 'default',
            "description" => 'System default workflow',
            "is_system_workflow" => true
        ]);
    }
}
