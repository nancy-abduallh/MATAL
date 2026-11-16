<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Event;
use App\Models\TouristRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Show the multi-step booking page.
     */
    public function create(Request $request): View
    {
        $type = $request->query('type', 'route');
        $id = $request->query('id');

        $item = null;
        if ($type === 'destination' && $id) {
            $item = Destination::find($id);
        } elseif ($type === 'event' && $id) {
            $item = Event::find($id);
        } elseif ($id) {
            $item = TouristRoute::find($id);
        }

        // Fallback default item (e.g. مسار المغامرات · وادي لجب as in Booking.png)
        if (! $item) {
            $item = TouristRoute::where('slug', 'wadi-lajab-adventure-route')->first()
                ?? TouristRoute::first();
            $type = 'route';
        }

        return view('pages.booking.create', compact('item', 'type'));
    }

    /**
     * Store a new booking in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:100',
            'trip_date' => 'required|date|after_or_equal:today',
            'adults_count' => 'required|integer|min:1|max:20',
            'children_count' => 'nullable|integer|min:0|max:20',
            'payment_method' => 'required|string|in:mada,apple_pay,visa,cash',
            'addons' => 'nullable|array',
            'notes' => 'nullable|string|max:500',
        ]);

        $bookableClass = match ($validated['bookable_type']) {
            'destination' => Destination::class,
            'event' => Event::class,
            default => TouristRoute::class,
        };

        $item = $bookableClass::findOrFail($validated['bookable_id']);

        $adults = (int) $validated['adults_count'];
        $children = (int) ($validated['children_count'] ?? 0);
        $basePrice = (float) $item->price;

        $subtotal = ($adults * $basePrice) + ($children * ($basePrice * 0.5));

        // Addons cost
        $addonsList = $request->input('addons', []);
        $addonsCost = 0;
        if (in_array('local_guide', $addonsList)) {
            $addonsCost += 150;
        }
        if (in_array('coffee_tasting', $addonsList)) {
            $addonsCost += 50 * ($adults + $children);
        }
        if (in_array('transport_4x4', $addonsList)) {
            $addonsCost += 200;
        }

        $totalPrice = max(0, $subtotal + $addonsCost);
        $bookingCode = 'MTL-'.strtoupper(Str::random(6));

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => Auth::id(),
            'bookable_type' => $bookableClass,
            'bookable_id' => $item->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'],
            'trip_date' => $validated['trip_date'],
            'adults_count' => $adults,
            'children_count' => $children,
            'total_price' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'status' => 'confirmed',
            'selected_addons' => $addonsList,
            'notes' => $validated['notes'] ?? null,
            'qr_code' => 'MTL-QR-'.$bookingCode,
        ]);

        return redirect()->route('booking.show', $booking->booking_code)
            ->with('success', 'تم تأكيد حجزك بنجاح!');
    }

    /**
     * Display the booking voucher and confirmation.
     */
    public function show(string $code): View
    {
        $booking = Booking::with('bookable')
            ->where('booking_code', $code)
            ->firstOrFail();

        return view('pages.booking.show', compact('booking'));
    }
}
