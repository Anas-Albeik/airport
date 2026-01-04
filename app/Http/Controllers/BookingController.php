<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;

class BookingController extends Controller
{


    public static function store(Request $request)
    {

        $flight = Flight::withCount(['bookings' => function ($query) {
            $query->where('status', 'confirmed');
        }])->findOrFail($request->flight_id);


        if ($flight->seats_remaining <= 0) {
            return response()->json([
                'message' => 'sorry, the flight is full!'
            ], 422);
        }


        $booking = $flight->bookings()->create([
            'user_id' => 1,
            'status' => 'confirmed',
            'seat_number' => 4,
            'flight_id' => $flight->id,

        ]);
        return response()->json([
            'message' => 'flight booked successfully!',
            'booking' => $booking,
            'remaining_after_booking' => $flight->seats_remaining - 1
        ], 201);
    }
}
