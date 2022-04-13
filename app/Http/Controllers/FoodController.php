<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Food;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class FoodController extends Controller
{

    public function index()
    {
        $data = Food::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'unique:food,name', 'regex:/^[a-zA-z ]{1,}$/',],
            'price' => ['required', 'gt:0',],
            'status' => ['required',],
        ]);

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->extension();
            $name = Str::random(20) . "." . $ext;
            $request->file('image')->storeAs("public/images/food", $name);
            $data['image'] = "images/food/" . $name;
        }
        Food::create($data);

        return response()->json(['message' => 'Food created sucessfully']);
    }


    public function show(Food $food)
    {
        return response()->json($food);
    }


    public function update(Request $request, Food $food)
    {
        // return $request->all();
        $data = $request->validate([
            'name' => ['required', 'unique:food,name,' . $food->id, 'regex:/^[a-zA-z ]{1,}$/',],
            'price' => ['required', 'gt:0',],
        ]);

        if ($request->hasFile('image')) {
            if ($request->image !== $food->image) {
                $request->validate([
                    'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                ]);
                $ext = $request->file('image')->extension();
                $name = Str::random(20) . "." . $ext;
                $request->file('image')->storeAs("public/images/food", $name);
                $data['image'] = "images/food/" . $name;
                if ($food->image) {
                    Storage::delete($food->image);
                }
            }
        }

        $food->update($data);

        return response()->json(['message' => 'Food Updated sucessfully']);
    }


    public function destroy(Food $food)
    {
        $food->delete();
        return response()->json(['message' => 'Food Item deleted Sucesfully']);
    }

    public function foodAvailable()
    {
        $food = Food::select('id', 'name', 'price', 'status', 'image')->where('status', '=', 'Available')->get();

        return response()->json($food);
    }

    public function changeAvailability(Food $food, Request $request)
    {
        $food->update([
            'status' => $request->status
        ]);

        return response()->json($food);
    }
}
