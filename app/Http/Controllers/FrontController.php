<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FrontController extends Controller
{
    public function viewRooms()
    {
        $roomTypes = Roomtype::with('amenities')->get();
        return response()->json($roomTypes);
    }

    public function roomAvailability(Request $request)
    {
        // return $request->all();
        $now = Carbon::now()->format('Y-m-d');
        $request->validate([
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . $now,  'date', 'before_or_equal:end_date',],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after:start_date',],
            'roomtype_id' => ['required', 'exists:roomtypes,id'],
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data['roomtype_id'] = $request->roomtype_id;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        // return $data['roomtype_id'];

        $room = Room::where('roomtype_id', '=', $data['roomtype_id'])->count();
        // return $room;

        $book_date = Book::where('roomtype_id', $data['roomtype_id'])
            ->whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->where('status', '!=', 'Canceled')
            ->orWhere('status', '!=', 'Checked Out')
            // ->where('status', "Confirmed")
            // ->where('status', "Pending")
            // ->here('status', 'Checked In')
            ->get()
            ->count();
        // return $book_date;

        $room_available = $room - $book_date;
        if ($room_available > 0) {
            $room = Roomtype::find($data['roomtype_id']);
            $room->load('amenities');
            return response()->json([$room]);
        } else {
            return response()->json([
                "message" => "No room available for your search",
            ]);
        }
    }

    public function canOrderFood()
    {
        $booking = Book::where('user_id', auth()->user()->id)->where('status', 'Checked In')->get();
        return $booking->count();
    }
}
