<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Food;
use App\Models\Room;
use App\Models\Order;
use App\Models\User;
use App\Notifications\FoodOrderPalced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['user', 'food', 'room'])->get();
        return response()->json($orders);
    }

    public function order_food(Request $request)
    {
        $data = $request->validate([
            'food_id' => ['required', 'exists:food,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['price'] = Food::where('id', $data['food_id'])->pluck('price')->sum() * $data['quantity'];

        $checkedinrooms = Book::where('user_id', $data['user_id'])->where('status', 'Checked In')->pluck('room_id');

        $data['room_id'] = $checkedinrooms->first();

        $room = Room::where('id', $data['room_id'])->first();
        $room_no = $room->room_no;
        // return $room_no;
        // $status = Book::where('user_id', $data['user_id'])
        //     ->where('room_id',)
        //     ->where('status', 'checkin')->pluck('status')->first();

        if (!$checkedinrooms) {
            return response()->json(['error' => "Restricted!", 'message' => 'you must checkin hotel to order food']);
        } else {
            $user = User::find($data['user_id']);
            $order = Order::create($data);
            $user->notify(new FoodOrderPalced($order));
            return response()->json(['messagetitle' => 'Order Successfull!', 'messagetext' => 'Your Order Will be Delivered to Room No. ' . $room_no]);
        }
    }

    public function changeStatus(Order $order, Request $request)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Order Status Updated',
        ]);
    }
}
