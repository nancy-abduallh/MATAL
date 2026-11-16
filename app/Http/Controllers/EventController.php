<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of upcoming seasonal festivals and events.
     */
    public function index(Request $request): View
    {
        $featuredEvent = Event::where('is_featured', true)->orderBy('date_start')->first();

        $query = Event::query();

        if ($featuredEvent) {
            $query->where('id', '!=', $featuredEvent->id);
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category', 'like', '%'.$request->input('category').'%');
        }

        $upcomingEvents = $query->orderBy('date_start')->paginate(6)->withQueryString();

        return view('pages.events.index', compact('featuredEvent', 'upcomingEvents'));
    }

    /**
     * Display the specified event.
     */
    public function show(string $slug): View
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $relatedEvents = Event::where('id', '!=', $event->id)->take(3)->get();

        return view('pages.events.show', compact('event', 'relatedEvents'));
    }
}
