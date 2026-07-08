<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Reel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function home(): View
    {
        $featured = Property::approved()->featured()->latest()->take(4)->get();
        $latest = Property::approved()->latest()->take(8)->get();
        $cities = Property::approved()->distinct()->orderBy('city')->pluck('city');
        $reelsStrip = Reel::approved()->with('property')->latest()->take(6)->get();
        $exploreCities = Property::approved()
            ->selectRaw('city, count(*) as properties_count')
            ->groupBy('city')
            ->orderByDesc('properties_count')
            ->take(6)
            ->get();

        return view('home', array_merge(
            compact('featured', 'latest', 'cities', 'reelsStrip', 'exploreCities'),
            config('homepage')
        ));
    }

    public function index(Request $request): View
    {
        $query = Property::approved()->with('user');

        if ($request->filled('city')) {
            $query->inCity($request->string('city'));
        }

        if ($request->filled('area')) {
            $query->inArea($request->string('area'));
        }

        if ($request->filled('type')) {
            $query->ofType($request->string('type'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->boolean('featured_only')) {
            $query->featured();
        }

        $properties = $query->orderByDesc('is_featured')->latest()->paginate(12)->withQueryString();
        $cities = Property::approved()->distinct()->orderBy('city')->pluck('city');

        return view('properties.index', compact('properties', 'cities'));
    }

    public function show(Property $property): View
    {
        abort_unless($property->status === 'approved', 404);

        return view('properties.show', compact('property'));
    }
}
