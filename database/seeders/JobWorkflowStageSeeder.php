<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobWorkflowStage;
use Illuminate\Support\Facades\Storage;

class JobWorkflowStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/workflow-stages.json");
        $datum = json_decode($file);

        foreach ($datum as $key => $data) {
            JobWorkflowStage::create([
                "name" => $data->name,
                "description" => $data->description,
                "order" => $data->order,
                "job_workflow_id" => 1
            ]);
        }
    }
}
