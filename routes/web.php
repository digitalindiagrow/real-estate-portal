<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\ReelController as AdminReelController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Dashboard\PropertyController as DashboardPropertyController;
use App\Http\Controllers\Dashboard\ReelController as DashboardReelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyEnquiryController;
use App\Http\Controllers\ReelController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/properties/{property}/enquiry', [PropertyEnquiryController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('properties.enquiry');
Route::get('/reels', [ReelController::class, 'index'])->name('reels.index');
Route::view('/contact', 'contact')->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'active'])->name('dashboard');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('my-properties', DashboardPropertyController::class)
        ->except(['show'])
        ->parameters(['my-properties' => 'property']);

    Route::post('/reels/{reel}/like', [ReelController::class, 'like'])->name('reels.like');
    Route::post('/reels/{reel}/comments', [ReelController::class, 'comment'])->name('reels.comments.store');

    Route::resource('my-reels', DashboardReelController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->parameters(['my-reels' => 'reel']);
});

Route::middleware(['auth', 'active', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/block', [AdminUserController::class, 'block'])->name('users.block');
    Route::patch('/users/{user}/unblock', [AdminUserController::class, 'unblock'])->name('users.unblock');
    Route::patch('/users/{user}/verify', [AdminUserController::class, 'toggleVerified'])->name('users.verify');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/properties', [AdminPropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{property}/edit', [AdminPropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [AdminPropertyController::class, 'update'])->name('properties.update');
    Route::patch('/properties/{property}/approve', [AdminPropertyController::class, 'approve'])->name('properties.approve');
    Route::patch('/properties/{property}/reject', [AdminPropertyController::class, 'reject'])->name('properties.reject');
    Route::patch('/properties/{property}/feature', [AdminPropertyController::class, 'toggleFeature'])->name('properties.feature');
    Route::delete('/properties/{property}', [AdminPropertyController::class, 'destroy'])->name('properties.destroy');

    Route::get('/reels', [AdminReelController::class, 'index'])->name('reels.index');
    Route::patch('/reels/{reel}/approve', [AdminReelController::class, 'approve'])->name('reels.approve');
    Route::patch('/reels/{reel}/reject', [AdminReelController::class, 'reject'])->name('reels.reject');
    Route::patch('/reels/{reel}/feature', [AdminReelController::class, 'toggleFeature'])->name('reels.feature');
    Route::delete('/reels/{reel}', [AdminReelController::class, 'destroy'])->name('reels.destroy');
    Route::delete('/reel-comments/{comment}', [AdminReelController::class, 'destroyComment'])->name('reels.comments.destroy');
});

require __DIR__.'/auth.php';
