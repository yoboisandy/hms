<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Hallbook;
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
            'hall_id' => ['required', 'exists:halls,id'],
            'start_date' => ['bail', 'required',  'required_with:end_date', 'after_or_equal:' . now(),  'date', 'before_or_equal:end_date'],
            'end_date' => ['bail', 'required', 'required_with:start_date', 'date', 'after_or_equal:start_date'],
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $data = ['user_id' => Auth::user()->id, 'hall_id' => $request->hall_id,];
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $hall = Hall::where('id', '=', $data['hall_id'])->count();

        // return $hall;

        $booking_halls = Hallbook::where('hall_id', $request->hall_id)
            ->whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->get()
            ->pluck('hall_id')
            ->count();

        // return $booking_halls;

        $hall_available = $hall - $booking_halls;
        if ($hall_available == 0) {
            return response()->json(['message' => 'No hall available for that date']);
        } else {
            Hallbook::create($data);
            return response()->json(['message' => 'Hall booked Sucessfully']);
        }
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
}
