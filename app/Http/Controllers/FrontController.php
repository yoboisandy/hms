<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Hall;
use App\Models\Hallbook;
use App\Models\Order;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function viewRooms()
    {
        $roomTypes = Roomtype::with('amenities')->get();
        return response()->json($roomTypes);
    }

    public function hallAvailability(Request $request)
    {
        $hall = Hall::find($request->hall_id);
        $now = Carbon::now()->format('Y-m-d');

        $data = $request->validate([
            'hall_id' => ['required', 'exists:halls,id'],
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . $now,  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
            'capacity' => ['required', 'lte:' . $hall->occupancy]
        ]);
        // return $request->hall_id;
        $booked = Hallbook::whereBetween('start_date', [$data["start_date"], $data["end_date"]])->orWhereBetween('end_date', [$data["start_date"], $data["end_date"]])->pluck('hall_id')->toArray();

        if (in_array($data['hall_id'], $booked)) {
            return response()->json(['error' => "This hall is not available for " .  $data['start_date'] . " to " . $data["end_date"]]);
        }
        return response()->json(["message" => "Hall is Available"]);
        // if ($booked >= 0) {
        //     return response()->json(['error' => "This hall is not available for " .  $data['start_date'] . " to " . $data["end_date"]]);
        // } else {
        //     return response()->json(["message" => "Hall is Available"]);
        // }
    }

    public function roomAvailability(Request $request)
    {
        $occupancy = Roomtype::findOrFail($request->roomtype_id)->occupancy;
        $now = Carbon::now()->format('Y-m-d');
        $data = $request->validate([
            // 'room_req' => ['required', 'gte:1'],
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . $now,  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
            'roomtype_id' => ['required', 'exists:roomtypes,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'occupancy' => ['required', "lte:" . $occupancy],
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $booking_rooms = Book::whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->get()
            ->pluck('room_id')
            ->toArray();

        $rooms = Room::whereNotIn('id', $booking_rooms)->get()->pluck('id')->toArray();

        if (in_array($data['room_id'], $rooms)) {
            return response()->json(['message' => 'Room is available']);
        } else {
            return response()->json(['error' => 'This room is not available please check another room']);
        }
    }

    public function canOrderFood()
    {
        // if (auth()->user()->name) {
        $booking = Book::where('user_id', auth()->user()->id)->where('status', 'Checked In')->get();
        return $booking->count();
        // } else {
        // return 0;
        // }
    }

    public function foodOrders()
    {
        // $id = Auth::user()->id;
        // return $id;
        $orders = Order::with('food', 'room')->where("user_id", auth()->user()->id)->get();
        return $orders;
    }
}
