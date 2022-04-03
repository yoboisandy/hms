<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order_food(Request $request)
    {
        $data = $request->validate([
            'food_id' => ['required', 'exists:food,id'],
            'room_id' => ['required', 'exists:books,room_id'],
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['price'] = Food::where('id', $data['food_id'])->pluck('price')->sum();

        // return $data['price'];
        $status = Book::where('user_id', $data['user_id'])
            ->where('room_id', $data['room_id'])
            ->where('status', 'checkin')->pluck('status')->first();

        if ($status != "checkin") {

            return response()->json(['message' => 'you must checkin hotel to order food']);
        } else {

            Order::create($data);

            return response()->json(['message' => 'Order sucess']);
        }
    }
}
