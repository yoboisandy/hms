<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Hallbook;


class ChartController extends Controller
{
    public function allTimeRoomReport()
    {
        $bookings = Book::selectRaw('count(id) as total_bookings, roomtype_id')->groupBy('roomtype_id')->get();
        $data = [];
        foreach ($bookings as $booking) {
            $data[] = [
                "roomtype" => $booking->roomtype->type_name,
                "total_bookings" => $booking->total_bookings
            ];
        }
        // return $data;
        return $data;
    }

    public function allTimeHallReport()
    {
        $bookings = Hallbook::selectRaw('count(id) as total_bookings, hall_id')->groupBy('hall_id')->get();

        $data = [];
        foreach ($bookings as $booking) {
            $data[] = [
                "hall" => $booking->hall->name,
                "total_bookings" => $booking->total_bookings
            ];
        }

        return $data;
    }
    public function thisWeekRoomReport()
    {
        $bookings = Book::selectRaw('count(id) as total_bookings,  DAYNAME(created_at) as day')->whereDate('created_at', '>=', now()->subDays(7))->groupBy('day')->orderBy('created_at')->get();
        $data = [];
        foreach ($bookings as $booking) {
            $data[] = [
                "total_bookings" => $booking->total_bookings,
                "day" => $booking->day
            ];
        }
        // return $data;
        return $data;
    }

    public function thisWeekHallReport()
    {
        $bookings = Hallbook::selectRaw('count(id) as total_bookings,  DAYNAME(created_at) as day')->whereDate('created_at', '>=', now()->subDays(7))->groupBy('day')->orderBy('created_at')->get();

        $data = [];
        foreach ($bookings as $booking) {
            $data[] = [
                "total_bookings" => $booking->total_bookings,
                "day" => $booking->day
            ];
        }

        return $data;
    }
}
