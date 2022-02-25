<?php

namespace Database\Seeders;

use App\Models\Housekeeping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HousekeepingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Housekeeping::create([
            'name' => 'Clean'
        ]);
        Housekeeping::create([
            'name' => 'Dirt'
        ]);
        Housekeeping::create([
            'name' => 'Cleaning'
        ]);
    }
}
