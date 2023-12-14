<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $this->call([
            CategorySeeder::class
        ]);
        User::factory()->count(10)->create();
        Place::factory()->count(10)->create();

        Review::factory()->count(20)->create();
    }
}
