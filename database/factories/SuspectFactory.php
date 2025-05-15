<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suspect>
 */
class SuspectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'crime_id' => 1, 
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'alias' => $this->faker->userName,
            'age' => $this->faker->numberBetween(18, 60),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['at large', 'in custody', 'released']),
        ];
    }
}
