<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'firstname' => 'Bibas',
            'lastname' => 'Ghimire',
            'email' => 'bibas.ghimire@gmail.com',
            'password' => bcrypt('password'),
            'dob' => '2007/10/12',
            'phone' => '1414142536',
            'department_id' => '2',
            'role_id' => '3',
            'designation' => 'Mr.',
            'address' => 'Tandi 6,Chitwan',
            'image' => '',
            'citizenship_number' => '12-4545-12457895',
            'pan_number' => '457894561',
            'joining_date' => '2075/2/14',
            'salary' => '5000',
            'shift_id' => '1',
        ]);
    }
}
