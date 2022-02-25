<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'Housekeeper',
        ]);
        Role::create([
            'name' => 'FrontDesk',
        ]);
        Role::create([
            'name' => 'Chef',
        ]);
        Role::create([
            'name' => 'Employee',
        ]);
        Role::create([
            'name' => 'Guest',
        ]);
    }
}
