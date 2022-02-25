<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Housekeeping',
        ]);
        Department::create([
            'name' => 'Kitchen',
        ]);
        Department::create([
            'name' => 'FrontOffice',
        ]);
    }
}
