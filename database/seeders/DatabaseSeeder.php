<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database to populate it with fake data.
     * run : php artisan db:seed
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->count(20)->create();
        Task::factory()->count(20)->create();
    }
}
