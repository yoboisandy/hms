<?php

namespace App\Http\Controllers;

use App\Models\Roomtype;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function viewRooms()
    {
        $roomTypes = Roomtype::with('amenities')->get();
        return response()->json($roomTypes);
    }
}
