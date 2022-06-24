<?php

namespace Database\Seeders;

use App\Models\JobSetting;
use Illuminate\Database\Seeder;

class JobSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobSetting::factory()
            ->count(5)
            ->create();
    }
}
