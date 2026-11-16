<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\TouristRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of destinations with sidebar filters.
     */
    public function index(Request $request): View
    {
        $query = Destination::with('category');

        if ($request->filled('category')) {
            $catSlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        if ($request->boolean('family_only')) {
            $query->where('is_family_friendly', true);
        }

        if ($request->filled('q')) {
            $term = '%'.$request->input('q').'%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('tagline', 'like', $term)
                    ->orWhere('region', 'like', $term)
                    ->orWhere('description', 'like', $term);
            });
        }

        $destinations = $query->latest('rating')->paginate(9)->withQueryString();
        $categories = Category::orderBy('order')->get();

        return view('pages.destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Display the specified destination detail page.
     */
    public function show(string $slug): View
    {
        $destination = Destination::where('slug', $slug)
            ->with(['category', 'reviews' => function ($q) {
                $q->where('is_approved', true)->latest();
            }])
            ->firstOrFail();

        $nearbyDestinations = Destination::where('id', '!=', $destination->id)
            ->where(function ($q) use ($destination) {
                $q->where('region', $destination->region)
                    ->orWhere('category_id', $destination->category_id);
            })
            ->take(3)
            ->get();

        if ($nearbyDestinations->isEmpty()) {
            $nearbyDestinations = Destination::where('id', '!=', $destination->id)->take(3)->get();
        }

        $relatedRoutes = TouristRoute::take(2)->get();

        return view('pages.destinations.show', compact('destination', 'nearbyDestinations', 'relatedRoutes'));
    }
}
