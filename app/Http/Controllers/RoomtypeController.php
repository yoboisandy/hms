<?php

namespace App\Http\Controllers;

use App\Models\Roomtype;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // return response()->json($request->all());


        $data = $request->validate([
            'type_name' => ['required', 'unique:roomtypes,type_name'],
            'description' => ['nullable'],
            'adult_occupancy' => ['required', 'integer', 'gt:0'],
            'child_occupancy' => ['required', 'integer', 'gt:0'],
            'image' => ['image', 'mimes:png,jpg,webp'],
            'base_occupancy' => ['required_with:higher_occupancy', 'min:1', 'integer', 'gt:0'],
            'higher_occupancy' => ['required_with:base_occupancy', 'min:2', 'integer', 'gt:0'],
            // 'extra_bed' => ['bail', 'required_with:extra_bed_price', 'integer', 'gt:0'],
            'extra_bed' => ['bail',  'integer'],
            'base_price' => ['required', 'integer', 'gt:0'],
            'additional_price' => ['required', 'integer', 'gt:0'],
            // 'extra_bed_price' => ['bail', 'required_with:extra_bed', 'integer', 'gt:0'],
            'extra_bed_price' => ['bail', 'integer', 'gt:0'],
            'amenities' => ['required', 'array'],
            // 'amenities.*' => ['exists:amenities,id'],
        ]);

        if ($request->file('image')) {
            $ext = $request->file('image')->extension();
            $name = Str::random(30) . "." . $ext;

            $request->file('image')->storeAs('public/images/roomtypes', $name);

            $data['image'] = "images/roomtypes/" . $name;
        }

        DB::transaction(function () use ($request, $data) {
            $roomtype = Roomtype::create($data);
            $roomtype->amenities()->sync($request->amenities);
        });


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
        $roomtype->load(['amenities', 'rooms']);

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
            'type_name' => ['required', 'unique:roomtypes,type_name', 'alpha'],
            'description' => ['nullable'],
            'adult_occupancy' => ['required', 'integer', 'gt:0'],
            'child_occupancy' => ['required', 'integer', 'gt:0'],
            'image' => ['image', 'mimes:png,jpg'],
            'base_occupancy' => ['required_with:higher_occupancy', 'min:1', 'integer', 'gt:0'],
            'higher_occupancy' => ['required_with:base_occupancy', 'min:2', 'integer', 'gt:0'],
            'extra_bed' => ['bail', 'required_with:extra_bed_price', 'integer', 'gt:0'],
            'base_price' => ['required', 'integer', 'gt:0'],
            'additional_price' => ['required', 'integer', 'gt:0'],
            'extra_bed_price' => ['bail', 'required_with:extra_bed', 'integer', 'gt:0'],
            'amenities' => ['required', 'array'],
            'amenities.*' => ['exists:amenities,id'],
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

    public function viewTypes(Roomtype $roomtype)
    {
        $roomtype->load('amenities');

        return response()->json($roomtype);
    }
}
