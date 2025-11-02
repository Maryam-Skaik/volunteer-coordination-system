<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::insert([
            [
                'volunteer_id' => 1,
                'task_id' => 2,
                'work_location_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'volunteer_id' => 2,
                'task_id' => 1,
                'work_location_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'volunteer_id' => 3,
                'task_id' => 3,
                'work_location_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
