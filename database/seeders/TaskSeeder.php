<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::insert([
            [
                'name' => 'Patient Transport',
                'work_location_id' => 1,
                'description' => 'Assist in transporting patients between departments.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Inventory Management',
                'work_location_id' => 2,
                'description' => 'Help maintain and organize medical supplies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reception Assistance',
                'work_location_id' => 3,
                'description' => 'Assist staff at the front desk with check-ins and queries.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
