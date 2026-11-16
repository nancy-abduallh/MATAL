<?php

namespace App\Models;

use Database\Factories\SavedTripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedTrip extends Model
{
    /** @use HasFactory<SavedTripFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'session_id',
        'title',
        'days_count',
        'group_type',
        'interests',
        'itinerary_data',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'interests' => 'array',
            'itinerary_data' => 'array',
        ];
    }

    /**
     * Get the user that owns the trip.
     *
     * @return BelongsTo<User, SavedTrip>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
