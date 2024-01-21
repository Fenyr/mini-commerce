<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->name();
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "image" => fake()->imageUrl(),
            "description" => fake()->paragraph(),
            "price" =>  floatval(fake()->numberBetween(1000, 2000)),
            "category_id" => fake()->numberBetween(1, 5),
            "stock" => fake()->numberBetween(1, 20),
            "preorder" => fake()->numberBetween(0, 5),
        ];
    }
}
