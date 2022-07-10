<?php

namespace Database\Factories;

use App\Models\Industry;
use App\Models\Candidate;
use App\Models\JobFunction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'gender_id' => $this->faker->numberBetween(0, 1),
            'dob' => $this->faker->dateTimeBetween($startDate='-30 years', $endDate='-20 years'),
            'headline' => $this->faker->text(64),
            'country_id' => 161,
            'region_id' => 303,
            'city_id' => 76744,
            'zip_code' => 105102,
            'address' => $this->faker->address(),
            'photo' => $this->faker->imageUrl($width=128, $height=128),
            'summary' => $this->faker->text(128),
            'resume' => $this->faker->imageUrl(),
            'skills' => $this->faker->randomElement(["Ms Word, Ms Excel, Dynamics, Accounting", "ASP, C#, NODE.JS, ANGULAR", "SQL, Mongo DB, SAAS", "Azure, AWS, GCP, Heroku"]),
            'industry_id' => $this->faker->randomElement(Industry::pluck('id')->toArray()),
            'job_function_id' => $this->faker->randomElement(JobFunction::pluck('id')->toArray()),
            'years_of_experience' => $this->faker->numberBetween(0, 20),

            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'reset_login' => $this->faker->boolean,
            'first_login' => $this->faker->boolean,
            'last_login' => $this->faker->dateTime,
            'is_active' => $this->faker->boolean,
        ];
    }
}
