<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title'=>fake()->title,
            'body'=>fake()->text('150'),
            'description'=>fake()->paragraph('4'),
            'user_id'=> User::InRandomOrder()->first()->id,
            'category_id'=> Category::InRandomOrder()->first()->id,
            'brand_id'=> Brand::InRandomOrder()->first()->id,
            'price'=>rand(1000,5000),
        ];
    }
}
