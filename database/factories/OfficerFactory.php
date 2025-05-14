<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officer>
 */
class OfficerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'badge_number' => strtoupper('B-' . Str::random(6)),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'rank' => $this->faker->randomElement(['Patrolman', 'Sergeant', 'Lieutenant', 'Chief Inspector']),
            'contact_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address,
            'active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}
