<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'room_id' => ['exists:rooms,id'],
            'start_date' => ['bail',  'required_with:end_date', 'after_or_equal:' . now(),  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
            'roomtype_id' => ['required'],
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data = ['user_id' => Auth::user()->id, 'room_id' => $request->room_id, 'roomtype_id' => $request->roomtype_id,];
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        //Counting room
        $room = Room::where('roomtype_id', '=', $data['roomtype_id'])->get();
        $count_room = $room->count();

        // $roomtype = Book::where('roomtype_id', "=", $data['roomtype_id'])->get();
        // $count_roomtype = Roomtype::where('id', "=", $data['roomtype_id'])->get('type_name');

        //counting booked room from booking table
        $book_room = Book::where('room_id', "=", $data['room_id'])->get();
        $count_book_room = $book_room->count();


        $booking_rooms = Book::whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->get();
        $count_booking_rooms = $booking_rooms->count();

        // return $count_booking_rooms;
        // return $count_room;

        if (($count_room - $count_book_room) > 0) {
            Book::create($data);
            return response()->json(['message' => 'Room booked Sucessfully']);
        } else {
            if (($count_room - $count_booking_rooms) > 0) {
                Book::create($data);
                return response()->json(['message' => 'Room booked Sucessfully']);
            }
        }





        // return $count_book_room;
        // return $count_roomtype;

        // $booking_rooms = Book::whereBetween('start_date', [$start_date, $end_date])
        //     ->orWhereBetween('end_date', [$start_date, $end_date])
        //     ->get()
        //     ->pluck('room_id')
        //     ->toArray();
        // if (in_array($request->room_id, $booking_rooms)) {
        //     die("Room not available");
        // }

        // return $booking_rooms;


        // Book::create($data);
        return response()->json(['message' => 'Sorry this type of room cannot be booked due to housefull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
