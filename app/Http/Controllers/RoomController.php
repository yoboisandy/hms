<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Room::with(['roomtype', 'floor'])->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_no' => ['required', 'unique:rooms,room_no'],
            'floor_id' => ['required', 'exists:floors,id'],
            'capacity' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'roomtype_id' => ['required', 'exists:roomtypes,id'],

        ]);

        Room::create($data);
        return response()->json(['message' => 'Room added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_no' => ['required', 'unique:rooms,room_no'],
            'floor_id' => ['required', 'exists:floors,id'],
            'capacity' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'roomtype_id' => ['required', 'exists:roomtypes,id'],

        ]);

        $room->update($data);
        return response()->json(['message' => 'Room Updated Sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Room Deleted Sucessfully']);
    }
}
