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
        Roomtype::create([
            'type_name' => 'Deluxe',
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
        Roomtype::create([
            'type_name' => 'Super Deluxe',
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
        Roomtype::create([
            'type_name' => 'Standard',
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
    }
}
