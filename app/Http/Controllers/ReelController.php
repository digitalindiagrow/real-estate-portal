<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Reel;
use App\Models\ReelLike;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReelController extends Controller
{
    public function index(Request $request): View
    {
        $query = Reel::approved()->with(['property', 'user', 'likes', 'comments.user'])->withCount(['likes', 'comments']);

        if ($request->filled('city')) {
            $city = $request->string('city');
            $query->whereHas('property', fn ($q) => $q->inCity($city));
        }

        if ($request->filled('type')) {
            $type = $request->string('type');
            $query->whereHas('property', fn ($q) => $q->ofType($type));
        }

        if ($request->filled('min_price')) {
            $minPrice = $request->input('min_price');
            $query->whereHas('property', fn ($q) => $q->where('price', '>=', $minPrice));
        }

        if ($request->filled('max_price')) {
            $maxPrice = $request->input('max_price');
            $query->whereHas('property', fn ($q) => $q->where('price', '<=', $maxPrice));
        }

        if ($request->input('sort') === 'popular') {
            $query->orderByDesc('likes_count');
        } else {
            $query->orderByDesc('is_featured')->latest();
        }

        $reels = $query->paginate(12)->withQueryString();
        $cities = Property::approved()->distinct()->orderBy('city')->pluck('city');
        $view = $request->input('view', 'grid') === 'list' ? 'list' : 'grid';

        return view('reels.index', compact('reels', 'cities', 'view'));
    }

    public function like(Request $request, Reel $reel): RedirectResponse
    {
        $existing = ReelLike::where('user_id', $request->user()->id)->where('reel_id', $reel->id)->first();

        if ($existing) {
            $existing->delete();
        } else {
            ReelLike::create(['user_id' => $request->user()->id, 'reel_id' => $reel->id]);
        }

        return back();
    }

    public function comment(Request $request, Reel $reel): RedirectResponse
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $reel->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return back()->with('status', 'Comment posted.');
    }
}
