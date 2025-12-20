<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => \App\Models\Flight::factory(),
            'user_id' => \App\Models\User::factory(),
            'class' => fake()->randomElement(['A', 'vip', 'Economy']),
            'price' => fake()->randomFloat(2, 100, 1000),
            'status' => fake()->randomElement(['booked', 'canceled', 'checked-in']),
        ];
    }
}
