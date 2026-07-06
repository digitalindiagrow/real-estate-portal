<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount('properties')->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function block(User $user): RedirectResponse
    {
        abort_if($user->isAdmin(), 403, 'Cannot block an admin account.');

        $user->update(['status' => 'blocked']);

        return back()->with('status', "Blocked {$user->name}.");
    }

    public function unblock(User $user): RedirectResponse
    {
        $user->update(['status' => 'active']);

        return back()->with('status', "Unblocked {$user->name}.");
    }

    public function toggleVerified(User $user): RedirectResponse
    {
        $user->update(['is_verified' => ! $user->is_verified]);

        return back()->with('status', $user->is_verified ? "Verified {$user->name}." : "Removed verified badge from {$user->name}.");
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        abort_if($user->isAdmin(), 403, 'Cannot delete an admin account.');
        abort_if($user->id === $request->user()->id, 403, 'Cannot delete your own account.');

        $user->delete();

        return back()->with('status', "Deleted {$user->name}.");
    }
}
