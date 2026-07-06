<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reel;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users' => User::count(),
            'blocked_users' => User::where('status', 'blocked')->count(),
            'total_properties' => Property::count(),
            'pending_properties' => Property::pending()->count(),
            'approved_properties' => Property::approved()->count(),
            'rejected_properties' => Property::where('status', 'rejected')->count(),
            'featured_properties' => Property::featured()->count(),
            'total_reels' => Reel::count(),
            'pending_reels' => Reel::pending()->count(),
        ];

        $recentPending = Property::pending()->with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPending'));
    }
}
