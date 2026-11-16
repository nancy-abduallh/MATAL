<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\TouristRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TouristRouteController extends Controller
{
    /**
     * Display a listing of tourist routes with interactive filters.
     */
    public function index(Request $request): View
    {
        $query = TouristRoute::query();

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        if ($request->filled('days')) {
            $days = (int) $request->input('days');
            $query->where('days_count', $days);
        }

        if ($request->filled('q')) {
            $term = '%'.$request->input('q').'%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('subtitle', 'like', $term)
                    ->orWhere('description', 'like', $term);
            });
        }

        $routes = $query->orderBy('badge')->paginate(9)->withQueryString();

        $categories = [
            'الكل' => 'all',
            'الجبال والمطلات' => 'الجبال والمطلات',
            'البن السعودي' => 'البن السعودي',
            'التراثي' => 'التراثي',
            'البحري' => 'البحري',
            'المغامرات' => 'المغامرات',
            'العائلي' => 'العائلي',
        ];

        return view('pages.routes.index', compact('routes', 'categories'));
    }

    /**
     * Display the specified tourist route detail page.
     */
    public function show(string $slug): View
    {
        $route = TouristRoute::where('slug', $slug)
            ->with(['reviews' => function ($q) {
                $q->where('is_approved', true)->latest();
            }])
            ->firstOrFail();

        $relatedRoutes = TouristRoute::where('id', '!=', $route->id)
            ->where('category', $route->category)
            ->take(3)
            ->get();

        if ($relatedRoutes->isEmpty()) {
            $relatedRoutes = TouristRoute::where('id', '!=', $route->id)
                ->take(3)
                ->get();
        }

        $sampleDestinations = Destination::take(3)->get();

        return view('pages.routes.show', compact('route', 'relatedRoutes', 'sampleDestinations'));
    }
}
