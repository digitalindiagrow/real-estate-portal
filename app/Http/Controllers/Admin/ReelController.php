<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use App\Models\ReelComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReelController extends Controller
{
    public function index(Request $request): View
    {
        $query = Reel::with(['property', 'user', 'comments.user'])->withCount(['likes', 'comments'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->boolean('featured_only')) {
            $query->where('is_featured', true);
        }

        $reels = $query->paginate(15)->withQueryString();

        return view('admin.reels.index', compact('reels'));
    }

    public function approve(Reel $reel): RedirectResponse
    {
        $reel->update(['status' => 'approved', 'rejection_reason' => null]);

        return back()->with('status', 'Reel approved.');
    }

    public function reject(Request $request, Reel $reel): RedirectResponse
    {
        $request->validate(['rejection_reason' => ['nullable', 'string', 'max:255']]);

        $reel->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        return back()->with('status', 'Reel rejected.');
    }

    public function toggleFeature(Reel $reel): RedirectResponse
    {
        $reel->update(['is_featured' => ! $reel->is_featured]);

        return back()->with('status', $reel->is_featured ? 'Reel marked as Featured.' : 'Reel removed from Featured.');
    }

    public function destroy(Reel $reel): RedirectResponse
    {
        Storage::disk('public')->delete(array_filter([$reel->video_path, $reel->thumbnail_path]));
        $reel->delete();

        return back()->with('status', 'Reel deleted.');
    }

    public function destroyComment(ReelComment $comment): RedirectResponse
    {
        $comment->delete();

        return back()->with('status', 'Comment deleted.');
    }
}
