<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightCardController extends Controller
{
    public function index(Request $request)
    {

        $flightsQuery = Flight::query();


        $flightsQuery->with([
            'departureAirport.city',
            'arrivalAirport.city',
            'airplane.company',
            'departureGate',
            'ticket',
        ]);

        if ($request->has('type') && $request->type == 'local') {
        }

        $flights = $flightsQuery->get();

        $formattedFlights = $flights->map(function ($flight) {
            return [
                'id' => $flight->id,
                'flight_number' => $flight->airplane->company->name . ' ' . $flight->airplane->serial_number,

                'type' => 'Local',
                'status' => $flight->status,

                'origin' => $flight->departureAirport->city->name,
                'destination' => $flight->arrivalAirport->city->name,

                'departure_time' => Carbon::parse($flight->departure_time)->format('H:i'),
                'arrival_time' => Carbon::parse($flight->arrival_time)->format('H:i'),

                'gate' => $flight->departureGate->gate_number ?? 'TBD',
                'terminal' => 'T1',

                'price' => $flight->ticket[0]->price ?? 150.00,
            ];
        });


        return response()->json([
            'status' => 'success',
            'data' => $formattedFlights
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        BookingController::store($request);
        return response()->json(['message' => 'Flight created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }
}
