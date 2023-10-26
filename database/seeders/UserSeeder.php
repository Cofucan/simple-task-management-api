<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1)->hasTasks(15)->create();
        User::factory()->count(1)->hasTasks(28)->create();
        User::factory()->count(1)->hasTasks(35)->create();
        User::factory()->count(1)->hasTasks(6)->create();
        User::factory()->count(2)->create();
    }
}
