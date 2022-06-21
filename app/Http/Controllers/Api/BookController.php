<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Ticket;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'station_from_id' => 'required|exists:stations,id',
            'station_to_id' => 'required|exists:stations,id',
        ]);

        $bus = Bus::find($validatedData['bus_id']);

        $tickets = Ticket::where('bus_id', '=', $validatedData['bus_id'])
            ->where('station_from_id', '>=', $validatedData['station_from_id'])
            ->where('station_to_id', '<=', $validatedData['station_to_id'])
            ->count();

        return response()->json([
            'data' => [
                'seats_available' => ($bus->seats_limit - $tickets),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'station_from_id' => 'required|exists:stations,id',
            'station_to_id' => 'required|exists:stations,id',
        ]);

        $bus = Bus::find($validatedData['bus_id']);

        $seats_not_available = Ticket::where('bus_id', '=', $validatedData['bus_id'])
            ->where('station_from_id', '>=', $validatedData['station_from_id'])
            ->where('station_to_id', '<=', $validatedData['station_to_id'])
            ->count();

        if ($seats_not_available >= $bus->seats_limit) {
            return response()->json([
                'message' => 'Seats not available'
            ], 400);
        }

        $ticket = Ticket::create([
            'user_id' => $request->user()->id,
            'bus_id' => $validatedData['bus_id'],
            'station_from_id' => $validatedData['station_from_id'],
            'station_to_id' => $validatedData['station_to_id'],
        ]);

        return response()->json([
            'message' => 'Seat reserved ticket number is: ' . $ticket->id
        ], 200);
    }
}
