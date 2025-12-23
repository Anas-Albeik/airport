<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use App\Models\Ticket;
use Database\Factories\FlightFactory;
use Illuminate\Http\Request;

class FlightController extends Controller
{



    public function index(FlightRequest $request)
    {
        $flights = Flight::query()->with(['airplane', 'ticket'])

        ->when($request->departure_airport_id, function ($query, $dep_id) {
            $query->where('departure_airport_id', $dep_id);
        })

        ->when($request->arrival_airport_id, function ($query, $arr_id) {
            $query->where('arrival_airport_id', $arr_id);
        })

        ->when($request->departure_time, function ($query, $date_dep) {
            $query->whereDate('departure_time', $date_dep);
        })
        ->when($request->arrival_time, function ($query, $date_arr) {
            $query->whereDate('arrival_time', $date_arr);
        })  
        ->paginate(10);
        return response()->json($flights, 200);



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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
