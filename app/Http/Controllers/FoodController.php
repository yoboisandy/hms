<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Food;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class FoodController extends Controller
{

    public function index()
    {
        // $data = Food::all();
        // return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'alpha',],
            'price' => ['required', 'gt:0',],
            'status' => ['required',],
        ]);

        Food::create($data);

        return response()->json(['message' => 'Food created sucessfully']);
    }


    public function show(Food $food)
    {
        //
    }


    public function update(Request $request, Food $food, $id)
    {
        $data = $request->validate([
            'status' => ['required',],
        ]);

        $food->where('id', $id)->update($data);

        return response()->json(['message' => 'Status updated Sucesfully']);
    }


    public function destroy(Food $food)
    {
        //
    }

    public function foodAvailable()
    {
        $food = Food::select('name', 'price')->where('status', '=', 'Available')->get();

        return response()->json($food);
    }

    public function foodAvailables()
    {
        $food = Food::select('name', 'price')->where('status', '=', 'Available')->get();

        return response()->json($food);
    }
}
