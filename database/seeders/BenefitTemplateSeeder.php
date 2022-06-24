<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BenefitTemplate;

class BenefitTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BenefitTemplate::factory()
            ->count(5)
            ->create();
    }
}
