<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'فعالية '.fake()->unique()->words(2, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->randomNumber(3)),
            'category' => fake()->randomElement(['جبلية', 'بحرية', 'تراثية', 'عائلية']),
            'date_start' => now()->addDays(fake()->numberBetween(1, 10)),
            'date_end' => now()->addDays(fake()->numberBetween(11, 20)),
            'date_text' => '15 - 20 يناير',
            'location' => 'جازان، الواجهة البحرية',
            'price' => fake()->randomFloat(2, 0, 100),
            'image' => '/images/farasan_islands.jpg',
            'description' => fake()->paragraph(),
            'is_featured' => fake()->boolean(),
            'tickets_available' => fake()->numberBetween(50, 300),
        ];
    }
}
