<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'email' => 'employee@employee.com',
            'password' => bcrypt('password'),
            'role' => 'Employee',
        ]);

        Employee::create([
            'firstname' => 'Employee',
            'lastname' => 'Detail',
            'email' => 'employee@employee.com',
            'password' => bcrypt('password'),
            'dob' => '2007/10/12',
            'phone' => '1414142536',
            'department_id' => '2',
            'role_id' => '4',
            'designation' => 'Mr',
            'address' => 'Tandi 6,Chitwan',
            'image' => 'images/employees/xedd84w8qWEucEnsTcEt.jpg',
            'citizenship_number' => '12-4545-12457895',
            'pan_number' => '457894561',
            'joining_date' => '2075/2/14',
            'salary' => '5000',
            'shift_id' => '1',
            'user_id' => '1',
        ]);
    }
}
