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
        $this->call(RoleSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(HousekeepingSeeder::class);
        $this->call(EmployeeSeeder::class);
    }
}
