<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
        ]);
        // $data[] = ['user_id' => Auth::user()->id];

        $data = ['user_id' => Auth::user()->id, 'room_id' => $request->room_id,];

        $book = Book::where('room_id', $data['room_id'])->exists();
        // $user = Book::where('user_id', $data['user_id'])->exists();

        // DB::transaction(function () use ($data) {
        // if ($book == $data['room_id'] || Auth::user()->id == $data['user_id']) {
        //     return response()->json(['message' => 'You have already booked this room']);
        // } else {
        // Book::create($data);
        // return response()->json(['message' => 'Room booked Sucessfully']);
        // }
        // });
        Book::create($data);
        return response()->json(['message' => 'Room booked Sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
