<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Amenity::with(['hall'])->get();
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
            'name' => ['required'],
            'description' => ['nullable'],
            'icon' => ['required', 'image', 'mimes:png,jpg']
        ]);

        $ext = $request->file('icon')->extension();
        $name = Str::random(30) . "." . $ext;

        $request->file('icon')->storeAs('public/images/amenities', $name);

        $data['icon'] = "images/amenities/" . $name;

        Amenity::create($data);

        return response()->json(["message" => "Amenity Added Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        return response()->json($amenity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenity $amenity)
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['nullable'],
            'icon' => ['required', 'image', 'mimes:png,jpg']
        ]);

        $ext = $request->file('icon')->extension();
        $name = Str::random(30) . "." . $ext;
        $request->file('icon')->storeAs('public/images/amenities', $name);
        $data['icon'] = "images/amenities/" . $name;

        if ($amenity->icon) {
            Storage::delete('public/' . $amenity->icon);
        }

        $amenity->update($data);

        return response()->json(["message" => "Amenity Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        if ($amenity->icon) {
            Storage::delete('public/images/amenities/' . $amenity->icon);
        }
        $amenity->delete();
        return response()->json(["message" => "Amenity deleted Successfully"]);
    }
}
