<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidates = Candidate::all();
        foreach ($candidates as $i => $candidate) {
            Education::factory()
            ->count(5)
            ->create([
                'candidate_id' => $candidate->id,
            ]);
        }
    }
}
