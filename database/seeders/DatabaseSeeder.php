<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        Place::factory()->count(10)->create();
        User::factory()->count(10)->create();

        $this->call([
            CategorySeeder::class
        ]);
    }
}
