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
            'role_id' => '4',
            'designation' => 'Mr',
            'address' => 'Tandi 6,Chitwan',
            'image' => 'images/amenities/RECBzrohMPpEKBMnlDyS8cNr0SK02v.jpg',
            'citizenship_number' => '12-4545-12457895',
            'pan_number' => '457894561',
            'joining_date' => '2075/2/14',
            'salary' => '5000',
            'shift_id' => '1',
        ]);

        Employee::create([
            'firstname' => 'Samer',
            'lastname' => 'Chettri',
            'email' => 'samir.chettri@gmail.com',
            'password' => bcrypt('password'),
            'dob' => '2020/10/12',
            'phone' => '1414464646',
            'department_id' => '1',
            'role_id' => '2',
            'designation' => 'Mr',
            'address' => 'Gaindakot 6,Nawalpur',
            'image' => 'hello.jpg',
            'citizenship_number' => '12-4545-12457895',
            'pan_number' => '45454785',
            'joining_date' => '2075/2/14',
            'salary' => '10000',
            'shift_id' => '2',
        ]);
        Employee::create([
            'firstname' => 'Dipendra',
            'lastname' => 'Sapkota',
            'email' => 'dipendra.sapkota@gmail.com',
            'password' => bcrypt('password'),
            'dob' => '2020/10/12',
            'phone' => '7894561230',
            'department_id' => '1',
            'role_id' => '2',
            'designation' => 'Mr',
            'address' => 'Gaindakot 8,Nawalpur',
            'image' => 'hello.jpg',
            'citizenship_number' => '12-4545-12457895',
            'pan_number' => '45454785',
            'joining_date' => '2075/2/14',
            'salary' => '10000',
            'shift_id' => '1',
        ]);
    }
}
