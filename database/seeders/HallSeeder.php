<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hall = Hall::create([
            "name" => "Meeting Hall",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "occupancy" => "15",
            "floor_id" => "1",
            "price" => "3000",
            "image" => "images/halls/L5pFpJzYqkF0LjtRQG8T.jpg",
        ]);
        $hall->amenities()->sync([1, 2, 5]);
        $hall = Hall::create([
            "name" => "Wedding or Party Hall",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "occupancy" => "300",
            "floor_id" => "1",
            "price" => "7000",
            "image" => "images/halls/OASZioNiJzmZ22t3t6a4.jpg",
        ]);
        $hall->amenities()->sync([1, 2, 5]);
        $hall = Hall::create([
            "name" => "Luxury Hall",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "occupancy" => "150",
            "floor_id" => "1",
            "price" => "22000",
            "image" => "images/halls/rkYziJ6uHHKBTquRO4up.jpg",
        ]);
        $hall->amenities()->sync([1, 2, 5]);
    }
}
