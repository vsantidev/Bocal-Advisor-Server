<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private $categories = ['Restaurant', 'Hôtel', 'Bar', 'Activités', 'Musées'];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name_category' => $category]);
    
        }
        echo array_rand($this->categories);
    }
}
