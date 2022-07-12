<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\ReservedRoom;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('room_types', 'services')->orderByDesc('id')->get();

        return Inertia::render('Rooms/Index', [
            'rooms' => $rooms,
        ]);
    }

    public function roomsPublic(Request $request)
    {
        $form = [
            'available_from' => $request->available_from ? $request->available_from : '',
            'available_till' => $request->available_till ? $request->available_till : '',
            'room_type_id'   => $request->room_type_id ? $request->room_type_id : '',
            'services' => '',
        ];

        $rooms = Room::select([
            'rooms.id',
            'rooms.available_from',
            'rooms.available_till',
            'rooms.description',
            'rooms.room_type_id',
            'room_types.name as room_types_name',
        ])
            ->leftJoin('room_types', 'room_types.id', 'rooms.room_type_id')
            ->with('services','reserved_rooms')
            ->when($request->available_from, function ($q) use ($request) {
                $q->whereDate('available_from', '<=', $request->available_from);
            })
            ->when($request->available_till, function ($q) use ($request) {
                $q->whereDate('available_till', '>=', $request->available_till);
            })
            ->when($request->room_type_id, function ($q) use ($request) {
                $q->where('rooms.room_type_id', $request->room_type_id);
            })
            ->when($request->services, function ($query) use ($request) {
                $query->whereHas('services', function ($q) use ($request) {
                    $q->whereIn('id', $request->services);
                });
            })
            ->orderByDesc('id')
            ->get();

        $request->services ? $form['services'] = Service::whereIn('id', $request->services)->get() : '';
        $room_types = RoomType::all();
        $services_options = Service::all();

        return Inertia::render('Rooms', [
            'rooms' => $rooms,
            'room_types' => $room_types,
            'services_options' => $services_options,
            'form' => $form
        ]);
    }


    public function create()
    {
        $room_types = RoomType::all();
        $services_options = Service::all();

        return Inertia::render('Rooms/Create', [
            'room_types' => $room_types,
            'services_options' => $services_options,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'room_type_id' => 'required',
            'available_from' => 'required|date',
            'available_till' => 'required|date|after_or_equal:available_from',
        ]);

        $room = Room::create($request->all());

        $all_services = [];
        if ($request->services) {
            foreach ($request->services as $service) {
                array_push($all_services, $service['id']);
            }
            $room->services()->attach($all_services);
        }

        return redirect()->route('rooms.index')->with('successMessage', 'Room was successfully created!');
    }

    public function edit($id)
    {
        $room = Room::with('services')->find($id);
        $room_types = RoomType::all();
        $services_options = Service::all();

        return Inertia::render('Rooms/Edit', [
            'room' => $room,
            'room_types' => $room_types,
            'services_options' => $services_options,
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'description' => 'required',
            'room_type_id' => 'required',
            'available_from' => 'required|date',
            'available_till' => 'required|date|after_or_equal:available_from',
        ]);

        $room->update([
            'description' => $request->description,
            'available_from' => $request->available_from,
            'available_till' => $request->available_till,
            'room_type_id' => $request->room_type_id,
        ]);

        $all_services = [];
        if (count($request->services)) {
            foreach ($request->services as $service) {
                array_push($all_services, $service['id']);
            }
        }

        if (empty($all_services)) {
            $room->services()->detach();
        } else {
            $room->services()->sync($all_services);
        }

        return redirect()->route('rooms.index')->with('successMessage', 'Room was successfully updated!');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('successMessage', 'Room was successfully deleted!');
    }
}
