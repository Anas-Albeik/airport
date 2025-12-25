<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'flight_id' => \App\Models\Flight::factory(),
            'seat_number' => $this->faker->numberBetween(50, 100),
            'status' => $this->faker->randomElement(['confirmed', 'cancelled']),
        ];
    }
}
