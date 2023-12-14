<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->text(),
            'rate' => fake()->numberBetween(0, 5),
            'picture_id' =>fake()->numberBetween(1, 10),
            'user_id' => fake()->numberBetween(1, 10),
            'place_id' => fake()->numberBetween(1, 10),
        ];
    }
}
