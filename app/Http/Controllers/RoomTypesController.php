<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\RoomType;

class RoomTypesController extends Controller
{
    public function index()
    {
        $room_types = RoomType::orderByDesc('id')->get();

        return Inertia::render('RoomTypes/Index', [
            'room_types' => $room_types,
        ]);
    }

    public function create()
    {
        return Inertia::render('RoomTypes/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        RoomType::create($request->all());

        return redirect()->route('room_type.index')->with('successMessage', 'Room type was successfully created!');
    }

    public function edit(RoomType $room_type)
    {

        return Inertia::render('RoomTypes/Edit', [
            'room_type' => $room_type,
        ]);
    }

    public function update(Request $request, RoomType $room_type)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $room_type->update([
            'name' => $request->name,
        ]);

        return redirect()->route('room_type.index')->with('successMessage', 'Room type was successfully updated!');
    }

    public function destroy(RoomType $room_type)
    {
        $room_type->delete();

        return redirect()->route('room_type.index')->with('successMessage', 'Room type was successfully deleted!');
    }
}
