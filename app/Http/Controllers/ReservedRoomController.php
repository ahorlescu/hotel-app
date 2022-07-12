<?php

namespace App\Http\Controllers;

use App\Models\ReservedRoom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservedRoomController extends Controller
{

    public function index()
    {
        $reserved_rooms = ReservedRoom::orderByDesc('id')->get();

        return Inertia::render('ReservedRooms/Index',[
            'reserved_rooms' => $reserved_rooms,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'reserved_from' => 'required|date',
            'reserved_till' => 'required|date',
            'room_id' => 'required', 
        ]);

        $room = ReservedRoom::create($request->all());

        return redirect()->route('rooms.public')->with('successMessage', 'Rezervarea a fost creata cu succes!');
    }


    public function destroy(ReservedRoom $reservedRoom)
    {
        $reservedRoom->delete();

        return redirect()->route('reserved.index')->with('successMessage', 'Reservation was successfully deleted!');
    }
}
