<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Volunteer;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Volunteer::insert([
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '123456789',
                'skills' => 'First Aid, Communication',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Smith',
                'email' => 'david.smith@example.com',
                'phone' => '987654321',
                'skills' => 'Logistics, Planning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'phone' => '555666777',
                'skills' => 'Medical Support, Organization',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
