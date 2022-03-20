<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'customer@customer.com',
            'password' => bcrypt('password'),
            'role' => 'Customer',
        ]);

        Customer::create([
            'firstname' => 'Asim',
            'lastname' => 'Poudel',
            'email' => 'aspo@customer.com',
            'phone' => '7894561230',
            'address' => 'Gaindakot',
            'citizenship_number' => '1-1-24515',
            'password' => bcrypt('password'),
            'user_id' => '2',
        ]);
    }
}
