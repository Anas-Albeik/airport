<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureTime = fake()->dateTimeBetween('now', '+1 week');
        $arrivalTime = fake()->dateTimeBetween($departureTime, $departureTime->format('Y-m-d H:i:s') . ' +8 hours');

        return [
            'airplane_id' => \App\Models\Airplane::factory(),
            'departure_gate' => \App\Models\Gates::factory(),
            'arrival_gate' => \App\Models\Gates::factory(),
            'departure_airport_id' => \App\Models\Airport::factory(),
            'arrival_airport_id' => \App\Models\Airport::factory(),
            'status' => fake()->randomElement(['arrived', 'canceled', 'Delayed', 'departed', 'On Time']),
            'total_capacity' => fake()->numberBetween(50, 100),
            'arrival_time' => $arrivalTime,
            'departure_time' => $departureTime,
        ];
    }
}
