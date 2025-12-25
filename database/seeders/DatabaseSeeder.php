<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\City;
use App\Models\Company;
use App\Models\Airport;
use App\Models\Gates;
use App\Models\Airplane;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\Review;
use App\Models\Loyalty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        City::factory(10)->create();
        Company::factory(10)->create();
        Airport::factory(10)->create();
        Gates::factory(10)->create();
        Airplane::factory(10)->create();
        Flight::factory(10)->create();
        User::factory(10)->create();
        Ticket::factory(10)->create();
        Review::factory(10)->create();
        Loyalty::factory(10)->create();
        Booking::factory(10)->create();
    }
}
