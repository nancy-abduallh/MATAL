<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination_id' => Destination::factory(),
            'tourist_route_id' => null,
            'user_id' => User::factory(),
            'author_name' => fake()->name(),
            'rating' => fake()->numberBetween(4, 5),
            'comment' => fake()->paragraph(),
            'is_approved' => true,
        ];
    }
}
