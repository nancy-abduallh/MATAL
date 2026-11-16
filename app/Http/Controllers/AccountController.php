<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\SavedTrip;
use App\Models\TouristRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display the user account dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();

        $bookings = Booking::with('bookable')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $savedTrips = SavedTrip::where('user_id', $user->id)
            ->latest()
            ->get();

        $myRoutes = TouristRoute::where('is_featured', true)->take(3)->get();

        return view('pages.account.index', compact('user', 'bookings', 'savedTrips', 'myRoutes'));
    }

    /**
     * Update user profile information.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'تم تحديث بيانات الحساب بنجاح!');
    }

    /**
     * Cancel an active booking.
     */
    public function cancelBooking(int $id): RedirectResponse
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'تم إلغاء الحجز بنجاح.');
    }
}
