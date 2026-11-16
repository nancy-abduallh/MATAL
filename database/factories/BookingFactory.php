<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\TouristRoute;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_code' => 'MTL-'.strtoupper(Str::random(6)),
            'user_id' => User::factory(),
            'bookable_type' => TouristRoute::class,
            'bookable_id' => TouristRoute::factory(),
            'customer_name' => fake()->name(),
            'customer_phone' => '05'.fake()->numerify('########'),
            'customer_email' => fake()->safeEmail(),
            'trip_date' => now()->addDays(fake()->numberBetween(2, 30)),
            'adults_count' => fake()->numberBetween(1, 4),
            'children_count' => fake()->numberBetween(0, 2),
            'total_price' => fake()->randomFloat(2, 150, 900),
            'payment_method' => fake()->randomElement(['mada', 'apple_pay', 'visa', 'cash']),
            'payment_status' => 'paid',
            'status' => 'confirmed',
            'selected_addons' => ['local_guide', 'coffee_tasting'],
            'notes' => fake()->optional()->sentence(),
            'qr_code' => 'QR-'.Str::random(12),
        ];
    }
}
