<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $title = $this->faker->text;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id' => 105,
            'sub_category_id' => random_int(181, 183),
            'user_id' => random_int(2, 3),
            'status' => random_int(0, 1),
            'is_approved' => random_int(0, 1),
            'description' => $this->faker->paragraph,
            'photo' => $this->faker->imageUrl(1000, 400, 'posts'),
        ];
    }
}
