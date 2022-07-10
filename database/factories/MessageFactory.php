<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $from_type = $this->faker->numberBetween(0, 1);
        return [
            'subject' => $this->faker->sentence(10),
            'body' => $this->faker->text,
            'from_user_type_id' => $from_type,
            'to_user_type_id' => $from_type == 1 ? 0 : 1,
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'candidate_id' => $this->faker->randomElement(Candidate::pluck('id')->toArray()),
            'reply_to' => null,
            'opened' => $this->faker->randomElement([true, false])
        ];
    }
}
