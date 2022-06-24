<?php

namespace Database\Factories;

use App\Models\JobSetting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => 'Mandatory',
            'lastname' => 'Mandatory',
            'email' => 'Mandatory',
            'phone' => 'Mandatory',
            'heading' => 'Mandatory',
            'address' => 'Mandatory',
            'photo' => 'Mandatory',
            'education' => 'Optional',
            'experience' => 'optional',
            'summary' => 'Mandatory',
            'resume' => 'Mandatory',
            'cover_letter' => 'Mandatory',
            'cv' => 'Mandatory',
            'job_id' => \App\Models\Job::factory(),
        ];
    }
}
