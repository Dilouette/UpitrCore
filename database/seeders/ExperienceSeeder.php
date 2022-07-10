<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
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
            Experience::factory()
            ->count(5)
            ->create([
                'candidate_id' => $candidate->id,
            ]);
        }        
    }
}
