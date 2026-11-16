<?php

namespace App\Models;

use Database\Factories\TouristRouteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TouristRoute extends Model
{
    /** @use HasFactory<TouristRouteFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'badge',
        'category',
        'subtitle',
        'description',
        'days_count',
        'duration_text',
        'difficulty',
        'rating',
        'reviews_count',
        'price',
        'image',
        'stops',
        'highlights',
        'included_services',
        'is_featured',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'stops' => 'array',
            'highlights' => 'array',
            'included_services' => 'array',
            'rating' => 'float',
            'price' => 'float',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get the reviews for the tourist route.
     *
     * @return HasMany<Review>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all of the route's bookings.
     *
     * @return MorphMany<Booking>
     */
    public function bookings(): MorphMany
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}
