<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airplane>
 */
class AirplaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => \App\Models\Company::factory(),
            'name' => fake()->randomElement(['Boeing 737', 'Airbus A320', 'Boeing 777', 'Airbus A380', 'Embraer E190']),
            'serial_number' => fake()->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'number_of_seats' => fake()->numberBetween(50, 500),
            'status' => fake()->randomElement(['active', 'inactive', 'maintenance']),
        ];
    }
}
