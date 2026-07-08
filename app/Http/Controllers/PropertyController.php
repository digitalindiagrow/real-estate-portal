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

        if ($request->filled('bedrooms')) {
            $query->bedrooms((int) $request->input('bedrooms'));
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

        match ($request->input('sort')) {
            'price_low' => $query->orderBy('price'),
            'price_high' => $query->orderByDesc('price'),
            'latest' => $query->latest(),
            default => $query->orderByDesc('is_featured')->latest(),
        };

        $properties = $query->paginate(12)->withQueryString();
        $cities = Property::approved()->distinct()->orderBy('city')->pluck('city');

        $type = $request->string('type')->value();
        $marketingKey = $type === 'rent' ? 'rent' : ($type === 'sale' ? 'buy' : null);

        $topLocalities = null;
        if ($marketingKey) {
            $topLocalities = Property::approved()
                ->ofType($type)
                ->selectRaw('area, city, count(*) as properties_count, min(price) as min_price, max(price) as max_price')
                ->groupBy('area', 'city')
                ->orderByDesc('properties_count')
                ->take(6)
                ->get();
        }

        return view('properties.index', array_merge(
            compact('properties', 'cities', 'type', 'topLocalities'),
            $marketingKey ? config("properties.{$marketingKey}") : []
        ));
    }

    public function show(Property $property): View
    {
        abort_unless($property->status === 'approved', 404);

        $property->load('user');

        $similar = Property::approved()
            ->ofType($property->type)
            ->inCity($property->city)
            ->where('id', '!=', $property->id)
            ->orderByDesc('is_featured')->latest()
            ->take(3)
            ->get();

        if ($similar->count() < 3) {
            $excludeIds = $similar->pluck('id')->push($property->id);
            $fallback = Property::approved()
                ->ofType($property->type)
                ->whereNotIn('id', $excludeIds)
                ->orderByDesc('is_featured')->latest()
                ->take(3 - $similar->count())
                ->get();
            $similar = $similar->concat($fallback);
        }

        $reel = $property->reels()->approved()->latest()->first();

        $mapEmbedUrl = 'https://www.google.com/maps?q='
            .urlencode(trim("{$property->address}, {$property->area}, {$property->city}", ', '))
            .'&output=embed';

        return view('properties.show', compact('property', 'similar', 'reel', 'mapEmbedUrl'));
    }
}
