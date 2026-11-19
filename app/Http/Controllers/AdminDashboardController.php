<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Review;
use App\Models\TouristRoute;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index(): View
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'total_users' => User::count(),
            'total_destinations' => Destination::count(),
            'total_routes' => TouristRoute::count(),
            'total_events' => Event::count(),
            'total_reviews' => Review::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
        ];

        $recentBookings = Booking::with('bookable')
            ->latest()
            ->take(8)
            ->get();

        $recentContacts = Contact::latest()->take(6)->get();

        $topDestinations = Destination::orderByDesc('rating')->take(5)->get();

        return view('pages.admin.index', compact('stats', 'recentBookings', 'recentContacts', 'topDestinations'));
    }

    /**
     * Update status of a booking.
     */
    public function updateBookingStatus(Request $request, int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);
        $status = $request->validate(['status' => 'required|in:confirmed,pending,completed,cancelled'])['status'];
        $booking->update(['status' => $status]);

        return back()->with('success', "تم تحديث حالة الحجز {$booking->booking_code} إلى {$status}");
    }

    /**
     * Mark a contact message as read.
     */
    public function markContactRead(int $id): RedirectResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        return back()->with('success', 'تم تحديد الرسالة كمقروءة.');
    }
}
