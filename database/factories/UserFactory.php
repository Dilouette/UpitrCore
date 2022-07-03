<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique->email,
            'username' => $this->faker->name,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'reset_login' => $this->faker->boolean,
            'first_login' => $this->faker->boolean,
            'last_login' => $this->faker->dateTime,
            'is_active' => $this->faker->boolean,
            'designation_id' => $this->faker->randomElement(Designation::pluck('id')->toArray()),
            'department_id' => $this->faker->randomElement(Department::pluck('id')->toArray()),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
