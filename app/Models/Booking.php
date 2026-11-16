<?php

namespace App\Models;

use Database\Factories\BookingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Booking extends Model
{
    /** @use HasFactory<BookingFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_code',
        'user_id',
        'bookable_type',
        'bookable_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'trip_date',
        'adults_count',
        'children_count',
        'total_price',
        'payment_method',
        'payment_status',
        'status',
        'selected_addons',
        'notes',
        'qr_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'trip_date' => 'date',
            'total_price' => 'float',
            'selected_addons' => 'array',
        ];
    }

    /**
     * Get the owning bookable model (Route, Destination, or Event).
     *
     * @return MorphTo<Model, Booking>
     */
    public function bookable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the booking.
     *
     * @return BelongsTo<User, Booking>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
