<?php

namespace Database\Factories;

use App\Models\TouristRoute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TouristRoute>
 */
class TouristRouteFactory extends Factory
{
    protected $model = TouristRoute::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'مسار '.fake()->unique()->word();

        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->randomNumber(3)),
            'badge' => '0'.fake()->numberBetween(1, 6),
            'category' => fake()->randomElement(['الجبال والمطلات', 'البن السعودي', 'التراثي', 'البحري', 'المغامرات', 'العائلي']),
            'subtitle' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'days_count' => fake()->numberBetween(1, 3),
            'duration_text' => 'يوم واحد',
            'difficulty' => fake()->randomElement(['سهل', 'متوسط', 'صعب']),
            'rating' => 4.85,
            'reviews_count' => fake()->numberBetween(15, 250),
            'price' => fake()->randomFloat(2, 120, 450),
            'image' => '/images/mountain_terraces.jpg',
            'stops' => [
                ['name' => 'المحطة الأولى', 'desc' => 'وصف المحطة', 'icon' => 'flag'],
                ['name' => 'المحطة الثانية', 'desc' => 'وصف المحطة', 'icon' => 'coffee'],
            ],
            'highlights' => ['إطلالة بانورامية', 'ضيافة جازانية أصيلة'],
            'included_services' => ['مواصلات حديثة', 'مرشد معتمد', 'وجبة خفيفة'],
            'is_featured' => true,
        ];
    }
}
