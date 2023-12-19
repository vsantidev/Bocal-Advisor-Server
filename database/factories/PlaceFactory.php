<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'street' => fake()->name(),
            'postcode' => fake()->numberBetween(06000, 91000),
            'city' => fake()->city(),
            'description' => fake()->text(),
            'x' => fake()->longitude(),
            'y' => fake()->latitude(),
            'user_id' => fake()->numberBetween(1, 10),
/*             'category_id' => fake()->numberBetween(1, 5), */
            'file' => fake()->name()
        ];
    }
}
