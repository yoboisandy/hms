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
            'name' => 'Chowmein',
            'price' => '100',
            'status' => 'Available',
        ]);
        Food::create([
            'name' => 'MoMo',
            'price' => '150',
            'status' => 'Available',
        ]);
        Food::create([
            'name' => 'Pizza',
            'price' => '450',
            'status' => 'Available',
        ]);
    }
}
