<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ticket::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'passenger_name' => 'required|string|max:100',
            'flight_id' => 'required|exists:flights,id',
            'seat_number' => 'required|string|max:5',
            'price' => 'required|numeric|min:0',
            'booking_date' => 'required|date',
        ]);
        Ticket::create($request->all(),
                        


    );
        return response()->json(['message' => 'Ticket created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'passenger_name' => 'sometimes|required|string|max:100',
            'flight_id' => 'sometimes|required|exists:flights,id',
            'seat_number' => 'sometimes|required|string|max:5',
            'price' => 'sometimes|required|numeric|min:0',
            'booking_date' => 'sometimes|required|date',
        ]);
        Ticket::findOrFail($ticket->id)
            ->update($request->all());
        return response()
            ->json(['message' => 'Ticket updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Ticket::findOrFail($ticket->id);
        Ticket::where('id', $ticket->id)->delete();
        return response()->json(['message' => 'Ticket deleted successfully'], 200);
    }
}
