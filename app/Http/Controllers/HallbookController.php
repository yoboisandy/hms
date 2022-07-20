<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\User;
use App\Models\Hallbook;
use App\Notifications\HallBookingCanceled;
use App\Notifications\HallBookingConfirmed;
use App\Notifications\HallBookingRequestSent;
use App\Notifications\HallmBookingCanceled;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HallbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Hallbook::withTrashed()->with('hall', 'user')->get();
        return $bookings;
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
            'hall_id' => ['required', 'exists:halls,id'],
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . now(),  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data = ['user_id' => Auth::user()->id, 'hall_id' => $request->hall_id,];
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        // $hall = Hall::where('id', '=', $data['hall_id'])->count();

        // return $hall;

        // $booking_halls = Hallbook::where('hall_id', $request->hall_id)
        //     ->whereBetween('start_date', [$start_date, $end_date])
        //     ->orWhereBetween('end_date', [$start_date, $end_date])
        //     ->get()
        //     ->pluck('hall_id')
        //     ->count();

        // return $booking_halls;

        // $hall_available = $hall - $booking_halls;
        // if ($booking_halls > 0) {
        //     return response()->json(['error' => 'No hall available for that date']);
        // } else {
        //     $hallbook = Hallbook::create($data);
        //     $bookingdetail = [
        //         "body" => "Your Hall Booking Request For " . $hallbook->hall->name . " Has Been Sent Successfully",
        //         "footer" => "We will reach back to you soon",
        //         "url" => url('localhost:3000/bookings')
        //     ];
        //     $user = User::find(auth()->user()->id);
        //     $user->notify(new HallBookingRequestSent($bookingdetail));
        //     return response()->json(['message' => 'Hall booked Sucessfully']);
        // }
        $booked = Hallbook::whereBetween('start_date', [$data["start_date"], $data["end_date"]])->orWhereBetween('end_date', [$data["start_date"], $data["end_date"]])->pluck('hall_id')->toArray();

        if (in_array($data['hall_id'], $booked)) {
            return response()->json(['error' => "This hall is not available for " .  $data['start_date'] . " to " . $data["end_date"]]);
        }
        $hallbook = Hallbook::create($data);
        $bookingdetail = [
            "body" => "Your Hall Booking Request For " . $hallbook->hall->name . " Has Been Sent Successfully",
            "footer" => "We will reach back to you soon",
            "url" => url('localhost:3000/bookings')
        ];
        $user = User::find(auth()->user()->id);
        $user->notify(new HallBookingRequestSent($bookingdetail));
        return response()->json(['message' => 'Hall booked Sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hallbook  $hallbook
     * @return \Illuminate\Http\Response
     */
    public function show(Hallbook $hallbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hallbook  $hallbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hallbook $hallbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hallbook  $hallbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hallbook $hallbook)
    {
        //
    }

    public function changeBookingStatus(Request $request, Hallbook $hallbook)
    {
        // return $request->status;
        $user = User::find($hallbook->user_id);
        // $book = Hallbook::withTrashed()->findOrFail($hallbook->id);

        if ($request->status == "Canceled" || $request->status == "Checked Out") {
            $hallbook->delete();
        }

        if ($request->status == "Canceled") {
            $user->notify(new HallBookingCanceled($hallbook));
        }

        $hallbook->update([
            'status' => $request->status
        ]);

        if ($hallbook->status == "Confirmed") {
            $user->notify(new HallBookingConfirmed($hallbook));
        }



        return response()->json([
            'message' => 'Booking Status Updated',
        ]);
    }

    public function showBookingOfUser()
    {
        $bookings = Hallbook::withTrashed()->orderBy('id', 'desc')->with(['hall', 'user'])->where('user_id', auth()->user()->id)->get();
        return response()->json($bookings);
    }
}
