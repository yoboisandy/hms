<?php

namespace App\Http\Controllers;

use App\Models\Roomtype;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomtypes = Roomtype::with(['amenities'])->get();
        // $roomtypes = Roomtype::all();
        return response()->json($roomtypes);
        // return view('welcme', compact('roomtypes'));
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
            'type_name' => ['required', 'unique:roomtypes,type_name'],
            'description' => ['nullable'],
            'adult_occupancy' => ['required'],
            'child_occupancy' => ['required'],
            'image' => ['image', 'mimes:png,jpg'],
            'base_occupancy' => ['required'],
            'higher_occupancy' => ['required'],
            'extra_bed' => ['required'],
            'base_price' => ['required'],
            'additional_price' => ['required'],
            'extra_bed_price' => ['required'],
            'amenities' => ['required', 'array'],
            'amenities.*' => ['exists:amenities,id'],
        ]);

        if ($request->file('image')) {
            $ext = $request->file('image')->extension();
            $name = Str::random(30) . "." . $ext;

            $request->file('image')->storeAs('public/images/roomtypes', $name);

            $data['image'] = "images/roomtypes/" . $name;
        }

        $roomtype = Roomtype::create($data);
        $roomtype->amenities()->sync($request->amenities);


        return response()->json(["message" => "Room Type Added Successsfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roomtype  $roomtype
     * @return \Illuminate\Http\Response
     */
    public function show(Roomtype $roomtype)
    {
        return response()->json($roomtype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roomtype  $roomtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roomtype $roomtype)
    {
        $data = $request->validate([
            'type_name' => ['required', 'unique:roomtypes,type_name,' . $roomtype->id],
            'description' => ['nullable'],
            'adult_occupancy' => ['required'],
            'child_occupancy' => ['required'],
            'image' => ['image', 'mimes:png,jpg'],
            'base_occupancy' => ['required'],
            'higher_occupancy' => ['required'],
            'extra_bed' => ['required'],
            'base_price' => ['required'],
            'additional_price' => ['required'],
            'extra_bed_price' => ['required'],
        ]);

        $ext = $request->file('image')->extension();
        $name = Str::random(30) . "." . $ext;
        $request->file('image')->storeAs('public/images/roomtypes', $name);
        $data['image'] = "images/roomtypes/" . $name;

        if ($roomtype->image) {
            Storage::delete('public/' . $roomtype->image);
        }


        $roomtype->update($data);
        $roomtype->amenities()->sync($request->amenities);

        return response()->json(["message" => "Room Type Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roomtype  $roomtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roomtype $roomtype)
    {

        $roomtype->delete();
        return response()->json(["message" => "Room Type Deleted Successfully"]);
    }
}
