<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::factory()
            ->create([
                'email' => 'candidate@upitr.com',
                'password' => Hash::make('Password@123'),
        ]);
        Candidate::factory()
            ->count(120)
            ->create([
                'photo' => null,
            ]);
    }
}
