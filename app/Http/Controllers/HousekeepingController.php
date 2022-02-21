<?php

namespace App\Http\Controllers;

use App\Models\Housekeeping;
use Illuminate\Http\Request;

class HousekeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Housekeeping::all();
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
            'name' => ['required', 'unique:housekeepings,name', 'alpha'],
        ]);

        Housekeeping::create($data);

        return response()->json(['message' => 'Housekeeping status added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function show(Housekeeping $housekeeping)
    {
        return response()->json($housekeeping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Housekeeping $housekeeping)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:housekeepings,name', 'alpha'],
        ]);

        $housekeeping->update($data);

        return response()->json(['message' => 'Housekeeping status updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Housekeeping $housekeeping)
    {
        $housekeeping->delete();

        return response()->json(['message' => 'Housekeeping status deleted sucessfully']);
    }
}
