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
            'roomtype_id' => '1',
        ]);

        Room::create([
            'room_no' => '101',
            'floor_id' => '3',
            'roomtype_id' => '2',
        ]);
        Room::create([
            'room_no' => '102',
            'floor_id' => '3',
            'roomtype_id' => '3',
        ]);
        Room::create([
            'room_no' => '103',
            'floor_id' => '3',
            'roomtype_id' => '3',
        ]);
        Room::create([
            'room_no' => '104',
            'floor_id' => '3',
            'roomtype_id' => '1',
        ]);
        Room::create([
            'room_no' => '105',
            'floor_id' => '3',
            'roomtype_id' => '2',
        ]);
    }
}
