<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ReelController extends Controller
{
    public function index(Request $request): View
    {
        $reels = $request->user()->reels()->with('property')->withCount(['likes', 'comments'])->latest()->paginate(10);

        return view('dashboard.reels.index', compact('reels'));
    }

    public function create(Request $request): View
    {
        $properties = $request->user()->properties()->approved()->get();

        return view('dashboard.reels.create', compact('properties'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Reel::class);

        $data = $request->validate([
            'property_id' => [
                'required',
                Rule::exists('properties', 'id')->where('user_id', $request->user()->id)->where('status', 'approved'),
            ],
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:51200'],
            'thumbnail' => ['nullable', 'image', 'max:5120'],
            'duration_seconds' => ['nullable', 'integer', 'min:1'],
        ]);

        $videoPath = $request->file('video')->store('reels/videos', 'public');
        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('reels/thumbnails', 'public')
            : null;

        Reel::create([
            'user_id' => $request->user()->id,
            'property_id' => $data['property_id'],
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'duration_seconds' => $data['duration_seconds'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('my-reels.index')->with('status', 'Reel submitted for admin approval.');
    }

    public function destroy(Reel $reel): RedirectResponse
    {
        $this->authorize('delete', $reel);

        Storage::disk('public')->delete(array_filter([$reel->video_path, $reel->thumbnail_path]));
        $reel->delete();

        return redirect()->route('my-reels.index')->with('status', 'Reel deleted.');
    }
}
