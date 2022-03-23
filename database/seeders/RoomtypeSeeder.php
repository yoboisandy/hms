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
            'adult_occupancy' => '2',
            'child_occupancy' => '2',
            'image' => 'images/roomtypes/TH6rvn6VgqyOQsNcBRJlHjb1wYRp0C.webp',
            'base_occupancy' => '2',
            'higher_occupancy' => '4',
            'extra_bed' => 1,
            'base_price' => '2500',
            'additional_price' => '2500',
            'extra_bed_price' => '1000'
        ]);
        $data->amenities()->sync([1, 2, 3, 5, 7]);
        $data = Roomtype::create([
            'type_name' => 'Super Deluxe Room',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quis fuga molestias et laboriosam vitae nulla quasi earum neque ratione? Tempora, accusantium aspernatur. Laudantium commodi sequi rerum hic amet alias? Dolores quibusdam consequuntur velit, veritatis doloremque rem deleniti repellat, quas sunt expedita dicta porro qui sapiente eum, tempora non similique!",
            'adult_occupancy' => '2',
            'child_occupancy' => '2',
            'image' => 'images/roomtypes/xAcEoknkereFInDUKfJxhQvLyoEJgh.webp',
            'base_occupancy' => '2',
            'higher_occupancy' => '4',
            'extra_bed' => 1,
            'base_price' => '2500',
            'additional_price' => '2500',
            'extra_bed_price' => '1000'
        ]);
        $data->amenities()->sync([1, 2, 3, 5]);
        Roomtype::create([
            'type_name' => 'Standard',
            'adult_occupancy' => '1',
            'child_occupancy' => '1',
            'image' => 'images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg',
            'base_occupancy' => '1',
            'higher_occupancy' => '1',
            'extra_bed' => 0,
            'base_price' => '1500',
            'additional_price' => '0',
            'extra_bed_price' => '0'
        ]);
        $data->amenities()->sync([1, 2,  5, 7]);
        Roomtype::create([
            'type_name' => 'Normal',
            'adult_occupancy' => '2',
            'child_occupancy' => '2',
            'image' => 'images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg',
            'base_occupancy' => '2',
            'higher_occupancy' => '4',
            'extra_bed' => 1,
            'base_price' => '2500',
            'additional_price' => '2500',
            'extra_bed_price' => '1000'
        ]);
        $data->amenities()->sync([1, 4, 3, 5, 7]);
        Roomtype::create([
            'type_name' => 'Star',
            'adult_occupancy' => '2',
            'child_occupancy' => '2',
            'image' => 'images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg',
            'base_occupancy' => '2',
            'higher_occupancy' => '4',
            'extra_bed' => 1,
            'base_price' => '2500',
            'additional_price' => '2500',
            'extra_bed_price' => '1000'
        ]);
        $data->amenities()->sync([1, 2, 3]);
        Roomtype::create([
            'type_name' => 'Standard',
            'adult_occupancy' => '2',
            'child_occupancy' => '2',
            'image' => 'images/roomtypes/TH6rvn6VgqyOQsNcBRJlHjb1wYRp0C.webp',
            'base_occupancy' => '2',
            'higher_occupancy' => '4',
            'extra_bed' => 1,
            'base_price' => '2500',
            'additional_price' => '2500',
            'extra_bed_price' => '1000'
        ]);
        $data->amenities()->sync([2, 3, 7]);
    }
}
