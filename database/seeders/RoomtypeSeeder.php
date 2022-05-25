<?php

namespace Database\Seeders;

use App\Models\Roomtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Roomtype::create([
            'type_name' => 'Deluxe Room',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quis fuga molestias et laboriosam vitae nulla quasi earum neque ratione? Tempora, accusantium aspernatur. Laudantium commodi sequi rerum hic amet alias? Dolores quibusdam consequuntur velit, veritatis doloremque rem deleniti repellat, quas sunt expedita dicta porro qui sapiente eum, tempora non similique!",
            'occupancy' => '4',
            'image' => 'images/roomtypes/1-king-bed.png',
            'price' => '2500'
        ]);
        $data->amenities()->sync([1, 2, 3, 5, 7]);
        $data = Roomtype::create([
            'type_name' => 'Super Deluxe Room',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quis fuga molestias et laboriosam vitae nulla quasi earum neque ratione? Tempora, accusantium aspernatur. Laudantium commodi sequi rerum hic amet alias? Dolores quibusdam consequuntur velit, veritatis doloremque rem deleniti repellat, quas sunt expedita dicta porro qui sapiente eum, tempora non similique!",
            'occupancy' => '4',
            'image' => 'images/roomtypes/2-Twin-Room.png',
            'price' => '2500'
        ]);
        $data->amenities()->sync([1, 2,  5, 7]);
        $data = Roomtype::create([
            'type_name' => 'Standard Room',
            'occupancy' => '4',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quis fuga molestias et laboriosam vitae nulla quasi earum neque ratione? Tempora, accusantium aspernatur. Laudantium commodi sequi rerum hic amet alias? Dolores quibusdam consequuntur velit, veritatis doloremque rem deleniti repellat, quas sunt expedita dicta porro qui sapiente eum, tempora non similique!",
            'image' => 'images/roomtypes/Presidential-Suite.png',
            'price' => '2500'
        ]);
        $data->amenities()->sync([2, 3, 7, 1]);
    }
}
