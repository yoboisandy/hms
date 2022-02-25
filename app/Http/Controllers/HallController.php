<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hall::with(['floor', 'amenity'])->get();
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
            'name' => ['required', 'unique:halls,name', 'alpha'],
            'description' => ['required'],
            'base_occupancy' => ['required'],
            'high_occupancy' => ['required'],
            'amenity_id' => ['required', 'exists:amenities, id'],
            'floor_id' => ['required', 'exists:floors,id'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'base_price' => ['required'],
            'high_price' => ['required'],
        ]);

        $name = Str::random(20);
        $ext = $request->file('image')->extension();
        $image_name = $name . "." . $ext;

        $data['image'] = $request->file('image')->storeAs('public/images/halls', $image_name);


        Hall::create($data);

        return response()->json(['message' => 'Hall added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        return response()->json($hall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:halls,name', 'alpha'],
            'description' => ['required'],
            'base_occupancy' => ['required'],
            'high_occupancy' => ['required'],
            'amenity_id' => ['required', 'exists:amenities, id'],
            'floor_id' => ['required', 'exists:floors,id'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'base_price' => ['required'],
            'high_price' => ['required'],
        ]);

        $name = Str::random(20);
        $ext = $request->file('image')->extension();
        $image_name = $name . "." . $ext;

        $data['image'] = $request->file('image')->storeAs('public/images/halls', $image_name);

        $hall->update($data);

        return response()->json(['message' => 'Hall updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();

        return response()->json(['message' => 'Hall deleted sucessfully']);
    }
}
