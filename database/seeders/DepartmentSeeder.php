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
        $dept = Department::create([
            'name' => 'Housekeeping',
        ]);
        $dept->roles()->sync([2]);

        $dept = Department::create([
            'name' => 'Kitchen',
        ]);
        $dept->roles()->sync([4, 5, 6]);

        $dept = Department::create([
            'name' => 'FrontOffice',
        ]);
        $dept->roles()->sync([3]);
    }
}
