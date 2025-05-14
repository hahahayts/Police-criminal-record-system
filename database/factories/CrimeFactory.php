<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crime>
 */
class CrimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // or use an existing ID if seeding
            'case_number' => strtoupper('CN-' . Str::random(8)),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['Theft', 'Assault', 'Homicide', 'Robbery', 'Fraud']),
            'location' => $this->faker->address,
            'incident_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'status' => $this->faker->randomElement(['open', 'under investigation', 'closed']),
        ];
    }
}
