<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use App\Models\Ticket;
use Database\Factories\FlightFactory;
use Illuminate\Http\Request;

class FlightController extends Controller
{



    public function index(Request $request, Flight $flights)
    {


        $data =  $flights->query()->with(['airplane', 'ticket'])
            ->when($request->departure_airport_id, function ($query, $dep_id) {
                $query->where('departure_airport_id', $dep_id);
            })
            ->when($request->arrival_airport_id, function ($query, $arr_id) {
                $query->where('arrival_airport_id', $arr_id);
            })
            ->when($request->departure_date, function ($query, $date_dep) {
                $query->whereDate('departure_date', $date_dep);
            })
            ->when($request->arrival_date, function ($query, $date_arr) {
                $query->whereDate('arrival_date', $date_arr);
            })->when($request->seat_number, function ($query, $seats) {
                $query->whereRaw('(total_capacity - (select count(*) from bookings where bookings.flight_id = flights.id and status = "confirmed")) >= ?', [$seats]);
            })->paginate(10);

        return response()->json($data, 200);
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
    public function show(Flight $flight, $id)
    {
        $flight = Flight::with(['airplane', 'ticket'])->findOrFail($id);
        return response()->json($flight, 200);
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
    public function update(Request $request, $id)
    {

        $data = Flight::findOrFail($id)
            ->update($request->all());
        return response()->json($data, 200, ['message' => 'Flight updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight, $id)
    {
        Flight::findOrFail($id);
        Flight::where('id', $id)->delete();
        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }
}
