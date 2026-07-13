<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image_path' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 1, 999),
            'is_paid' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
