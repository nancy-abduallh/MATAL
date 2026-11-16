<?php

namespace App\Models;

use Database\Factories\DestinationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Destination extends Model
{
    /** @use HasFactory<DestinationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'tagline',
        'description',
        'story',
        'region',
        'location_name',
        'latitude',
        'longitude',
        'image',
        'gallery',
        'best_time',
        'duration',
        'difficulty',
        'is_family_friendly',
        'has_parking',
        'road_condition',
        'weather_summary',
        'rating',
        'reviews_count',
        'price',
        'is_featured',
        'tags',
        'facilities',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'rating' => 'float',
            'price' => 'float',
            'is_family_friendly' => 'boolean',
            'has_parking' => 'boolean',
            'is_featured' => 'boolean',
            'gallery' => 'array',
            'tags' => 'array',
            'facilities' => 'array',
        ];
    }

    /**
     * Get the category that owns the destination.
     *
     * @return BelongsTo<Category, Destination>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the reviews for the destination.
     *
     * @return HasMany<Review>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all of the destination's bookings.
     *
     * @return MorphMany<Booking>
     */
    public function bookings(): MorphMany
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}
