<?php

namespace Database\Seeders;

use App\Models\Sublike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SublikeSeeder extends Seeder
{
    private $like = ['upvoter', 'subvoter'];

    public function run(): void
    {
        foreach ($this->like as $sublike) {
            Sublike::create([
                'react' => $sublike]);
    
        }
        echo array_rand($this->like);
    }

}
