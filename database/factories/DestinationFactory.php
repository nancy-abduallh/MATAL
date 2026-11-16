<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Destination>
 */
class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->city().' التراثية';

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->randomNumber(4)),
            'tagline' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'story' => fake()->paragraphs(2, true),
            'region' => fake()->randomElement(['فيفا', 'الداير', 'الريث', 'فرسان', 'جازان']),
            'location_name' => fake()->streetAddress(),
            'latitude' => 17.15 + fake()->randomFloat(4, -0.5, 0.5),
            'longitude' => 43.10 + fake()->randomFloat(4, -0.5, 0.5),
            'image' => '/images/mountain_terraces.jpg',
            'gallery' => ['/images/mountain_terraces.jpg', '/images/coastal_beach.jpg'],
            'best_time' => 'الصباح الباكر',
            'duration' => 'ساعتان',
            'difficulty' => fake()->randomElement(['سهل', 'متوسط', 'صعب']),
            'is_family_friendly' => true,
            'has_parking' => true,
            'road_condition' => 'معبد ومفتوح',
            'weather_summary' => 'معتدل 22°C',
            'rating' => fake()->randomFloat(2, 4.5, 5.0),
            'reviews_count' => fake()->numberBetween(10, 500),
            'price' => fake()->randomFloat(2, 0, 150),
            'is_featured' => fake()->boolean(40),
            'tags' => ['طبيعة', 'تراث', 'إطلالة'],
            'facilities' => ['مواقف', 'مرشد سياحي', 'مقهى'],
        ];
    }
}
