<?php

namespace Database\Seeders;

use App\Models\Assesment;
use Illuminate\Database\Seeder;
use App\Models\AssesmentQuestion;

class AssesmentQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assesments = Assesment::all();
        
        foreach ($assesments as $i => $assesment) { 
            AssesmentQuestion::factory()
            ->count(20)
            ->create([
                'assesment_id' => $assesment->id,
                'question_type_id' => 1,
            ]);
        }
    }
}
