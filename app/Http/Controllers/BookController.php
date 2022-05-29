<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Food;
use App\Models\Room;
use App\Models\Order;
use App\Models\Roomtype;
use App\Models\User;
use App\Notifications\BookingConfirmed;
use App\Notifications\BookingRequestSent;
use App\Notifications\BookingStatusChanged;
use App\Notifications\RoomBookingCanceled;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Book::withTrashed()->with(['roomtype.rooms', 'user', 'room'])->get();
        return response()->json($room);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $occupancy = Roomtype::findOrFail($request->roomtype_id)->occupancy;
        $now = Carbon::now()->format('Y-m-d');
        $request->validate([
            // 'room_req' => ['required', 'gte:1'],
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . $now,  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
            'roomtype_id' => ['required', 'exists:roomtypes,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'occupancy' => ['required', "lte:" . $occupancy],
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data = ['user_id' => Auth::user()->id, 'room_id' => $request->room_id, 'roomtype_id' => $request->roomtype_id,];
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $a = Roomtype::select('price')->where('id', $data['roomtype_id'])
            ->get('price');
        $price = $a->sum('price');

        $data['price'] = $price;

        $booking_rooms = Book::whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->get()
            ->pluck('room_id')
            ->toArray();

        $rooms = Room::whereNotIn('id', $booking_rooms)->get()->pluck('id')->toArray();

        if (in_array($data['room_id'], $rooms)) {
            $book = Book::create($data);
            $bookingdetail = [
                "body" => "Your Booking Request for Room No. " . $book->room->room_no .  " of type: " . $book->roomtype->type_name . " Has Been Sent Successfully",
                "footer" => "We will reach back to you soon",
                "url" => url('localhost:3000/bookings')
            ];
            $user = User::find(auth()->user()->id);
            $user->notify(new BookingRequestSent($bookingdetail));
            return response()->json(['message' => 'Room booked sucessfuly']);
        } else {
            return response()->json(['error' => 'Not available that room for that day!!']);
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

        $book->where('id', $id)->update($data);

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
        $food = Order::where('user_id', $id)->where('status', 'delivered')->sum('price');
        $price = $food + $room;
        return "Total price is: " . $price;
    }

    public function showBookingOfUser()
    {
        $bookings = Book::withTrashed()->orderBy('id', 'desc')->with(['roomtype', 'room'])->where('user_id', auth()->user()->id)->get();
        return response()->json($bookings);
    }

    public function changeBookingStatus(Request $request, Book $book)
    {
        $user = User::find($book->user_id);
        $book->update([
            'status' => $request->status
        ]);
        if ($book->status == "Confirmed") {
            $user->notify(new BookingConfirmed($book));
        }

        if ($book->status === "Canceled") {
            $user->notify(new RoomBookingCanceled($book));
        }

        if ($book->status == "Checked Out" || $book->status == "Canceled") {
            $book->delete();
        }


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
