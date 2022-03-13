<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Shift::with('employees')->get();

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
            'name' => ['required', 'unique:shifts,name', 'alpha'],
        ]);

        Shift::create($data);

        return response()->json(['message' => 'Shift added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        return response()->json($shift);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $data = $request->validate([]);
        if ($shift->name != $request->name) {
            $data = $request->validate([
                'name' => ['required', 'unique:shifts,name', 'alpha'],
            ]);
        }

        $shift->update($data);

        return response()->json(['message' => 'Shift updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();

        return response()->json(['message' => 'Shift deleted successfully']);
    }
}
