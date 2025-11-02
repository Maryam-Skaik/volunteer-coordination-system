<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkLocation;

class WorkLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkLocation::insert([
            [
                'name' => 'Central Hospital',
                'address' => '123 Main St, City Center',
                'description' => 'Main emergency response hospital in the city.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'North Clinic',
                'address' => '456 North Rd, Uptown',
                'description' => 'Specialized clinic for minor injuries.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'East Field Camp',
                'address' => '789 East Blvd, Field Zone',
                'description' => 'Mobile support unit in the field area.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
