<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evidence>
 */
class EvidenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           return [
            'crime_id' => 1, // or use existing crime ID when seeding
            'type' => $this->faker->randomElement(['Weapon', 'CCTV Footage', 'Document', 'Fingerprint', 'Clothing']),
            'name' => $this->faker->words(2, true), // e.g., "Knife Handle", "Security Video"
            'description' => $this->faker->sentence,
            'file_path' => null, // Or simulate a file path like 'uploads/evidence1.jpg'
            'date_collected' => $this->faker->date(),
            'collected_by' => $this->faker->name,
        ];
    }
}
