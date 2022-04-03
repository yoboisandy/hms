<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin Admin",
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'Admin',
        ]);
        User::create([
            "name" => "Kitchen Kitchen",
            'email' => 'kitchen@kitchen.com',
            'password' => bcrypt('password'),
            'role' => 'Kitchen',
        ]);
    }
}
