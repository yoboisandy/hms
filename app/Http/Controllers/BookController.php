<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Food;
use App\Models\Room;
use App\Models\Order;
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
        $room = Book::with(['roomtype.rooms', 'user', 'room'])->get();
        return response()->json($room);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Roomtype $roomtype)
    {
        $roomt = Roomtype::findOrFail($request->roomtype_id);
        $rt_base_occupancy = $roomt->base_occupancy;
        $rt_higher_occupancy = $roomt->higher_occupancy;
        $rt_child_occupancy = $roomt->child_occupancy;
        $rt_adult_occupancy = $roomt->adult_occupancy;
        // $total_request = $request->adult_occupancy + $request->child_occupancy;




        $request->validate([
            // 'room_req' => ['required', 'gte:1'],
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . now(),  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
            // 'roomtype_id' => ['required'],
            'child_occupancy' => ['required', 'lte:' . $rt_child_occupancy, 'gte:0'],
            'adult_occupancy' => ['required', 'lte:' . $rt_adult_occupancy, 'gte:0'],
            'number_of_people' => ['lte:' . $rt_higher_occupancy, 'gte:' . $rt_base_occupancy]
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data = ['user_id' => Auth::user()->id, 'room_id' => $request->room_id, 'roomtype_id' => $request->roomtype_id,];
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $a = Roomtype::select('base_price')->where('id', '=', $data['roomtype_id'])
            // ->pluck('base_price')
            ->get('base_price');
        $price = $a->sum('base_price');

        $data['price'] = $price;

        //Counting room
        $room = Room::where('roomtype_id', '=', $data['roomtype_id'])->count();
        // return $room;
        // return $count_book_room;
        $booking_rooms = Book::where('roomtype_id', $request->roomtype_id)
            ->whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->get()
            ->pluck('roomtype_id')
            ->count();
        // return $booking_rooms;


        $room_available = $room - $booking_rooms;
        // return $room_available;

        if ($room_available == 0) {
            return response()->json(['message' => 'no room available']);
        } else {
            // $data['room_id'] = Roomtype::findOrFail($data['roomtype_id'])->room()->first()->id;
            // return $data['room_id'];
            Book::create($data);
            // $room_available = $room_available - $data['room_req'];
            return response()->json(['message' => 'Room booked Sucessfully']);
        }
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
    public function update(Request $request, Book $book, $id)
    {
        $data = $request->validate([
            'room_id' => ['required', 'exists:rooms,id', 'unique:books,room_id',],
        ]);
        $data['status'] = 'confirmed';
        $book->where('id', '=', $id)->update($data);

        return response()->json(['message' => 'Room allocated to that bookings!!']);
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
    public function calculate($id)
    {
        $room = Book::where('user_id', $id)->where('status', 'checkin')->sum('price');
        $food = Order::where('user_id', $id)->where('status', 'complete')->sum('price');
        $price = $food + $room;
        return "Total price is: " . $price;
    }

    public function showBookingOfUser()
    {
        $bookings = Book::orderBy('id', 'desc')->with(['roomtype', 'room'])->where('user_id', auth()->user()->id)->get();
        return response()->json($bookings);
    }

    public function changeBookingStatus(Request $request, Book $book)
    {
        $book->update([
            'status' => $request->status
        ]);
        return response()->json([
            'message' => 'Booking Status Updated',
        ]);
    }
    public function assignRoom(Request $request, Book $book)
    {
        $booked_rooms = $book->whereBetween('start_date', [$book->start_date, $book->end_date])
            ->orWhereBetween('end_date', [$book->start_date, $book->end_date])
            ->pluck('room_id');

        // return $booked_rooms;

        if ($booked_rooms->contains($request->room_id)) {
            return response()->json([
                "message" => "Room Already assigned"
            ]);
        }
        $book->update([
            'room_id' => $request->room_id
        ]);
        return response()->json([
            'message' => 'Room Assigned Successfully',
        ]);
    }
}
