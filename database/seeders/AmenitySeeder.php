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
            "name" => "Air Conditioner",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/Nm6eKdCg4Vzwl7MBv78ZBPXkIxtRPn.png",
        ]);
        Amenity::create([
            "name" => "Coffee Maker",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/2Qw5C85W9mEF4zQyUUAXKmq1jCqGzw.png",

        ]);
        Amenity::create([
            "name" => "Iron",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/CMoT4XhogRMaa4KZNGeDF1k59sCJeQ.png",

        ]);
        Amenity::create([
            "name" => "Refridgerator",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/fMooeM3x3c5Nb7UbBaX9dEU33GIthF.png",
        ]);
        Amenity::create([
            "name" => "LED Television",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/ilzy8dkGOF9u8FeweYcgSc6LiA4XxA.png",
        ]);
        Amenity::create([
            "name" => "Washing Machine",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/PrbD5CsaUPrTWJ0nwWvJTqvapK0en9.png",
        ]);
        Amenity::create([
            "name" => "Hot Tub",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil commodi cum quis error. A maxime eum molestiae odio incidunt quod.
    ",
            "icon" => "images/amenities/vgdS2Qwm1lTPSw400QIm2jZ4c7Nj8s.png",
        ]);
    }
}
