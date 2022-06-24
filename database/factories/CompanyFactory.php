<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique->name,
            'email' => $this->faker->unique->email,
            'website' => $this->faker->text(255),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'bio' => $this->faker->sentence(15),
            'logo' => $this->faker->text,
            'hiring_thumbnail' => $this->faker->text,
        ];
    }
}
