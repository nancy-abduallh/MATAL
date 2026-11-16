<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Review;
use App\Models\TouristRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'destination_id' => 'nullable|exists:destinations,id',
            'tourist_route_id' => 'nullable|exists:tourist_routes,id',
            'author_name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'destination_id' => $validated['destination_id'] ?? null,
            'tourist_route_id' => $validated['tourist_route_id'] ?? null,
            'user_id' => Auth::id(),
            'author_name' => $validated['author_name'],
            'rating' => (int) $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => true,
        ]);

        // Update rating on destination or route
        if ($review->destination_id) {
            $dest = Destination::find($review->destination_id);
            if ($dest) {
                $avg = $dest->reviews()->where('is_approved', true)->avg('rating');
                $count = $dest->reviews()->where('is_approved', true)->count();
                $dest->update(['rating' => round($avg, 2), 'reviews_count' => $count]);
            }
        } elseif ($review->tourist_route_id) {
            $route = TouristRoute::find($review->tourist_route_id);
            if ($route) {
                $avg = $route->reviews()->where('is_approved', true)->avg('rating');
                $count = $route->reviews()->where('is_approved', true)->count();
                $route->update(['rating' => round($avg, 2), 'reviews_count' => $count]);
            }
        }

        return back()->with('success', 'شكراً لمشاركتك تقييمك وتجربتك الملهمة!');
    }
}
