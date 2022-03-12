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
            'firstname' => 'Asim',
            'lastname' => 'Poudel',
            'email' => 'aspo@customer.com',
            'phone' => '7894561230',
            'address' => 'Gaindakot',
            'citizenship_number' => '1-1-24515',
            'password' => bcrypt('password'),
        ]);

        Customer::create([
            'firstname' => 'Sandeep',
            'lastname' => 'Sharma',
            'email' => 'sash@customer.com',
            'phone' => '7894578430',
            'address' => 'Bharatpur-12',
            'citizenship_number' => '1-2-24515',
            'password' => bcrypt('password')
        ]);

        Customer::create([
            'firstname' => 'Sujan',
            'lastname' => 'Maskey',
            'email' => 'suku@customer.com',
            'phone' => '7894561650',
            'address' => 'Nepalgunj',
            'citizenship_number' => '1-1-24515',
            'password' => bcrypt('password'),
        ]);
    }
}
