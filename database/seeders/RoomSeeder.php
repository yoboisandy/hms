<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'room_no' => '100',
            'floor_id' => '2',
            'capacity' => '3',
            'price' => '10000',
            'description' => 'This is best room!',
            'roomtype_id' => '3',
            'status' => 'pending',
        ]);

        Room::create([
            'room_no' => '101',
            'floor_id' => '3',
            'capacity' => '4',
            'price' => '50000',
            'description' => 'This is best of the best room!',
            'roomtype_id' => '2',
            'status' => 'pending',
        ]);
    }
}
