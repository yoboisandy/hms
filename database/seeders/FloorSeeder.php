<?php

namespace Database\Seeders;

use App\Models\Floor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Floor::create([
            "name" => "First",
            "floor_number" => "1",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia exercitationem, nihil voluptatum quam iure esse! Nemo, sit pariatur a ea esse nam perferendis, vel obcaecati, reiciendis commodi voluptates. Temporibus, eum rerum. Provident reiciendis harum cumque velit nihil, optio soluta iusto?"
        ]);
        Floor::create([
            "name" => "Second",
            "floor_number" => "2",

            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia exercitationem, nihil voluptatum quam iure esse! Nemo, sit pariatur a ea esse nam perferendis, vel obcaecati, reiciendis commodi voluptates. Temporibus, eum rerum. Provident reiciendis harum cumque velit nihil, optio soluta iusto?"
        ]);
        Floor::create([
            "name" => "Third",
            "floor_number" => "3",

            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia exercitationem, nihil voluptatum quam iure esse! Nemo, sit pariatur a ea esse nam perferendis, vel obcaecati, reiciendis commodi voluptates. Temporibus, eum rerum. Provident reiciendis harum cumque velit nihil, optio soluta iusto?"
        ]);
        Floor::create([
            "name" => "Fourth",
            "floor_number" => "4",

            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia exercitationem, nihil voluptatum quam iure esse! Nemo, sit pariatur a ea esse nam perferendis, vel obcaecati, reiciendis commodi voluptates. Temporibus, eum rerum. Provident reiciendis harum cumque velit nihil, optio soluta iusto?"
        ]);
        Floor::create([
            "name" => "Fifth",
            "floor_number" => "5",

            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia exercitationem, nihil voluptatum quam iure esse! Nemo, sit pariatur a ea esse nam perferendis, vel obcaecati, reiciendis commodi voluptates. Temporibus, eum rerum. Provident reiciendis harum cumque velit nihil, optio soluta iusto?"
        ]);
    }
}
