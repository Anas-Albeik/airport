<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;

class BookingController extends Controller
{


    public static function store(Request $request)
{

    $flight = Flight::findOrFail($request->flight_id);



    // if ($flight->isFull()) {
    //     return back()->with('error', 'Sorry, this flight is already full!');
    // }

    Booking::create([
        'user_id' => 1,
        'flight_id' => $flight->id,
        'seat_number' => 5,
        'status' => 'confirmed'
    ]);

    return back()->with('success', 'Seat booked successfully!');
}
}
