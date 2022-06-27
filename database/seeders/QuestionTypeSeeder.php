<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/question-types.json");
        $types = json_decode($file);

        foreach ($types as $key => $type) {
            QuestionType::create([
                "name" => $type,
                "description" => $type
            ]);
        }
    }
}
