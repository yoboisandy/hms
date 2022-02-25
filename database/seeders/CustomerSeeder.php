<?php

namespace Database\Seeders;

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
        Customer::create([
            'firstname' => 'Customer',
            'lastname' => 'Detail',
            'email' => 'customer@customer.com',
            'phone' => '7894561230',
            'address' => 'Customer_address',
            'citizenship_number' => '1-1-24515',
            'password' => bcrypt('password'),
        ]);

        Customer::create([
            'firstname' => 'Customer2',
            'lastname' => 'Detail',
            'email' => 'customer2@customer.com',
            'phone' => '7894578430',
            'address' => 'Customer1_address',
            'citizenship_number' => '1-2-24515',
            'password' => bcrypt('password')
        ]);

        Customer::create([
            'firstname' => 'Customer3',
            'lastname' => 'Detail',
            'email' => 'customer3@customer.com',
            'phone' => '7894561650',
            'address' => 'Customer3_address',
            'citizenship_number' => '1-1-24515',
            'password' => bcrypt('password'),
        ]);
    }
}
