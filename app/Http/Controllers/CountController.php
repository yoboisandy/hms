<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Hall;
use App\Models\Room;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function countAll()
    {
        $count = [
            "department" => Department::count(),
            "employee" => Employee::count(),
            "room" => Room::count(),
            "hall" => Hall::count(),
            "customer" => Customer::count(),
        ];
        return response()->json($count);
    }
}
