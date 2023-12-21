<?php

namespace Database\Seeders;

use App\Models\CategoryPlace;
use Illuminate\Database\Seeder;

class CategoryPlaceSeeder extends Seeder
{

    public $categoryPlace = [
        '1' => ['category_id' => 4, 'place_id' => 1],
        '2' => ['category_id' => 2, 'place_id' => 2],
        '3' => ['category_id' => 1, 'place_id' => 3]
    ];

    public function run(): void
    {
        foreach ($this->categoryPlace as $categoryPlaces => $details) {
            CategoryPlace::factory()->create([
                'category_id' => $details['category_id'],
                'place_id' => $details['place_id'],
            ]);
        }
    }
}
