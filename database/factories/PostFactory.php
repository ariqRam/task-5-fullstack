<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_ids = Category::pluck('id')->toArray();
        return [
            'user_id' => User::all()->random()->id,
            'category_id' => $category_ids[array_rand($category_ids)],

            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(8),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
