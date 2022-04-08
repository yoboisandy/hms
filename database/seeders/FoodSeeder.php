<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food::create([
            'name' => 'Chicken Biryani',
            'price' => '400',
            'status' => 'Available',
            'image' => 'images/food/chicken-biryani.jpg'
        ]);
        Food::create([
            'name' => 'Veg Chowmein',
            'price' => '150',
            'status' => 'Available',
            'image' => 'images/food/chowmein.jpg'
        ]);
        Food::create([
            'name' => 'Buff Momo',
            'price' => '250',
            'status' => 'Available',
            'image' => 'images/food/momo.jpg'
        ]);
    }
}
