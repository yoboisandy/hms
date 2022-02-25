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
            "name" => "Hall A",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "base_occupancy" => "2",
            "high_occupancy" => "3",
            "floor_id" => "1",
            "image" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
            "base_price" => "2400",
            "high_price" => "3000",

        ]);
        $hall->amenities()->sync([1, 2, 4]);
        $hall = Hall::create([
            "name" => "Hall B",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "base_occupancy" => "2",
            "high_occupancy" => "3",
            "floor_id" => "1",
            "image" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
            "base_price" => "2400",
            "high_price" => "3000",

        ]);
        $hall->amenities()->sync([1, 2, 4]);
        $hall = Hall::create([
            "name" => "Hall C",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "base_occupancy" => "2",
            "high_occupancy" => "3",
            "floor_id" => "1",
            "image" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
            "base_price" => "2400",
            "high_price" => "3000",

        ]);
        $hall->amenities()->sync([1, 2, 4]);
        $hall = Hall::create([
            "name" => "Hall D",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "base_occupancy" => "2",
            "high_occupancy" => "3",
            "floor_id" => "1",
            "image" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
            "base_price" => "2400",
            "high_price" => "3000",

        ]);
        $hall->amenities()->sync([1, 2, 4]);
        $hall = Hall::create([
            "name" => "Hall E",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam iste laborum necessitatibus sequi reprehenderit aspernatur labore est officiis itaque.",
            "base_occupancy" => "2",
            "high_occupancy" => "3",
            "floor_id" => "1",
            "image" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
            "base_price" => "2400",
            "high_price" => "3000",

        ]);
        $hall->amenities()->sync([1, 2, 4]);
    }
}
