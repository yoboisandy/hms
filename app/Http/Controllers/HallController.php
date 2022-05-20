<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\PseudoTypes\Numeric_;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hall::with(['floor', 'amenities'])->get();
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
            'name' => ['required', 'unique:halls,name', 'regex:/^[a-zA-z ]{1,}$/'],
            'description' => ['required'],
            'occupancy' => ['bail', 'required', 'integer', 'gt:0', 'min:1'],
            // 'amenity_id' => ['required', 'exists:amenities,id'],
            'floor_id' => ['required', 'exists:floors,id'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'price' => ['bail', 'required', 'integer', 'gt:0', 'min:1'],
            'amenities' => ['required', 'array'],
            'amenities.*' => ['exists:amenities,id'],
        ]);

        $name = Str::random(20);
        $ext = $request->file('image')->extension();
        $image_name = $name . "." . $ext;

        $request->file('image')->storeAs('public/images/halls', $image_name);
        $data['image'] = $data['image'] = "images/halls/" . $image_name;


        DB::transaction(function () use ($data, $request) {
            $hall = Hall::create($data);
            $hall->amenities()->sync($request->amenities);
        });

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
        $hall->load(['amenities', 'floor']);
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
            'name' => ['required', 'unique:halls,name,' . $hall->id, 'regex:/^[a-zA-z ]{1,}$/'],
            'description' => ['required'],
            'occupancy' => ['bail', 'required', 'integer', 'gt:0', 'min:1'],
            // 'amenity_id' => ['required', 'exists:amenities,id'],
            'floor_id' => ['required', 'exists:floors,id'],
            // 'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'price' => ['bail', 'required', 'integer', 'gt:0', 'min:1'],
            // 'amenities' => ['required', 'array'],
            // 'amenities.*' => ['exists:amenities,id'],
        ]);



        if ($request->hasFile('image')) {
            if ($request->image !== $hall->image) {
                $name = Str::random(20);
                $ext = $request->file('image')->extension();
                $image_name = $name . "." . $ext;
                $request->file('image')->storeAs('public/images/halls', $image_name);
                $data['image'] = "images/halls/" . $image_name;
                Storage::delete($hall->image);
            }
        }

        DB::transaction(function () use ($data, $request, $hall) {
            $hall->update($data);
            // $hall->amenities()->sync($request->amenities);
        });

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

    public function viewHall(Hall $hall)
    {
        $hall->load('amenities');

        return response()->json($hall);
    }
}
