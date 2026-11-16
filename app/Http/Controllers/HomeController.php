<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Review;
use App\Models\TouristRoute;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the main landing page of MATAL.
     */
    public function index(): View
    {
        $categories = Category::orderBy('order')->get();

        $featuredRoutes = TouristRoute::where('is_featured', true)
            ->take(6)
            ->get();

        $allRoutes = TouristRoute::orderBy('badge')->get();

        $featuredDestinations = Destination::where('is_featured', true)
            ->with('category')
            ->take(6)
            ->get();

        $upcomingEvents = Event::where('is_featured', true)
            ->orderBy('date_start')
            ->take(3)
            ->get();

        $recentReviews = Review::with(['destination', 'touristRoute'])
            ->where('is_approved', true)
            ->latest()
            ->take(4)
            ->get();

        // High impact stats
        $stats = [
            'destinations_count' => '500+',
            'routes_count' => '50+',
            'providers_count' => '300+',
            'rating' => '4.8',
        ];

        return view('pages.home', compact(
            'categories',
            'featuredRoutes',
            'allRoutes',
            'featuredDestinations',
            'upcomingEvents',
            'recentReviews',
            'stats'
        ));
    }
}
