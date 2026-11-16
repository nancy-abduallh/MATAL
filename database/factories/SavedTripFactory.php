<?php

namespace Database\Factories;

use App\Models\SavedTrip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SavedTrip>
 */
class SavedTripFactory extends Factory
{
    protected $model = SavedTrip::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'session_id' => null,
            'title' => 'رحلة استكشاف جازان',
            'days_count' => 2,
            'group_type' => 'عائلة',
            'interests' => ['جبال', 'طبيعة', 'مزارع'],
            'itinerary_data' => [
                'day_1' => ['مطل الدرب', 'مزرعة البن', 'إقامة ريفية'],
                'day_2' => ['قرية آل يحيى', 'وادي لجب'],
            ],
        ];
    }
}
