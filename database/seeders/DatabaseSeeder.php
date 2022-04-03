<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AmenitySeeder::class,
            DepartmentSeeder::class,
            ShiftSeeder::class,
            HousekeepingSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            FloorSeeder::class,
            RoomtypeSeeder::class,
            RoomSeeder::class,
            HallSeeder::class,
            FoodSeeder::class,
        ]);
    }
}
