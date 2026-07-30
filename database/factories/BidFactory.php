<?php

namespace Database\Factories;

use App\Models\Bid;
use App\Models\User;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class BidFactory extends Factory
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
            'advertisement_id' => Advertisement::factory(),
            'amount' => function (array $attributes) {
                $advertisementId = $attributes['advertisement_id'];
                $advertisement = Advertisement::find($advertisementId);
                $maxPrice = $advertisement ? $advertisement->price : 999;

                return $this->faker->randomFloat(2, 1, $maxPrice);
            },
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
