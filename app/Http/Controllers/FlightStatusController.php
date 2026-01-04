<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightStatusController extends Controller
{
    public function index(Request $request, Flight $flights)
    {
        $flights->query()->with('airplane')
            ->when($request->arrival_airport_id, function ($query, $arr_id) {
                $query->where('arrival_airport_id', $arr_id);
            })
            ->when($request->departure_date, function ($query, $date_dep) {
                $query->whereDate('departure_time', $date_dep);
            })
            ->paginate(10);
        return response()->json($flights, 200);
    }
}
