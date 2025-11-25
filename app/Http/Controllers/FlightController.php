<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function validateRequest(Request $request)
    {
        return $request->validate([
            'flight_number' => 'required|string|max:10|unique:flights,flight_number',
            'city_id'=>'required|string|max:10|country_exists:city_id',
            'arrival_airport' => 'required|string|max:100',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|string|in:schedule,delayed,cancelled,departed,arrived',
            'gate_id'=>'required|string|max:5'
        ]);
    }

    public function index()
    {
        $tickets = Flight::tickets()->user_id();
        $data = Flight::all();
        return response()->json($data);
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

        static::validateRequest($request);
        Flight::create($request->all());
        return response()->json(['message' => 'Flight created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
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
        static::validateRequest($request);
        Flight::findOrFail($flight->id);
        Flight::where('id', $flight->id)->update($request->all());
        return response()->json(['message' => 'Flight updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        Flight::findOrFail($flight->id);
        Flight::where('id', $flight->id)->delete();
        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }
}
