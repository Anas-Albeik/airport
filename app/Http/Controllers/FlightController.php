<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class FlightController extends Controller
{



    public function index(FlightRequest $request)
    {
        $flights=Flight::with('airplane','tickets')
        ->where('departure_airport_id'==request('departure_airport_id'))
        ->where('arrival_airport_id'==request('arrival_airport_id'))->get();
        // ->whereHas('airplane')->where('seats','>=',request('seats'))
        // ->whereDate('departure_time','==',request('departure_time'))
        // ->whereDate('arrival_time','==',request('arrival_time'))
        dd($request->all());
        return response()->json($flights, 200);
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
