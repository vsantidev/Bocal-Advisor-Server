<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'SerVer',
            'lastname' => 'Nier',
            'email' => 'Servertest@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('topsecret'),
            'username' => 'SerVer',
            'birthday' => '2017/02/23',
            'role'=> 'admin',
        ]);

        User::factory()->create([
            'firstname' => 'Tsuyu',
            'lastname' => 'Wyvern',
            'email' => 'tsuyuwolf@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('wolfsecret'),
            'username' => 'Tsuyu',
            'birthday' => '1987/09/04',
            'role'=> 'gerant',
        ]);

        User::factory()->create([
            'firstname' => 'Lulu',
            'lastname' => 'Lemon',
            'email' => 'LuluLemon@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('lulusecret'),
            'username' => 'Lulu',
            'birthday' => '2000/05/29',
            'role'=> 'membre',
        ]);

        User::factory()->count(10)->create();

        $this->call([
            CategorySeeder::class,
            PlaceSeeder::class,
            ReviewSeeder::class,
        ]);




    }
}
