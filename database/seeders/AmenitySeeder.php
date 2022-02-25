<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *
     * @return void
     */
    public function run()
    {
        Amenity::create([
            "name" => "Ac",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
        ]);
        Amenity::create([
            "name" => "Fridge",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",

        ]);
        Amenity::create([
            "name" => "TV",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",

        ]);
        Amenity::create([
            "name" => "Heater",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
        ]);
        Amenity::create([
            "name" => "Water Bottle",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg",
        ]);
    }
}
