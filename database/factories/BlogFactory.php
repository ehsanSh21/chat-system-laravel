<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'body'=>fake()->text('50'),
            'description'=>fake()->paragraph('4'),
            'user_id'=>User::InRandomOrder()->first()->id,
            'category_id'=> Category::InRandomOrder()->first()->id,
        ];
    }
}
