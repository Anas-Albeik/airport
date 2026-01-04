<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->with('flight')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $tickets

        ]);
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

    }

    /**
     * Display the specified resource.
     */
   public function show($id)
    {
        $ticket = Ticket::with(['flight', 'user', 'review'])->find($id);

        if (!$ticket) {
            return response()->json(['message' => 'NOT FOUNT'], 404);
        }

        if ($ticket->user_id !== Auth::id()) {
             return response()->json(['message' => 'NOT ALLOWED'], 403);
        }

        return response()->json($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        
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
