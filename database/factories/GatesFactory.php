<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gates>
 */
class GatesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gate_number' => fake()->unique()->regexify('Gate [A-Z][0-9]{1,2}'),
            'status' => fake()->randomElement(['available', 'occupied', 'maintenance']),
        ];
    }
}
