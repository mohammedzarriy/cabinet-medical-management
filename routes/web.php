<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

// ── Welcome ──
Route::get('/', function () {
    $services = \App\Models\Service::all();
    return view('welcome', compact('services'));
});

// ── Locale switcher ──
Route::get('/locale/{lang}', function (string $lang) {
    if (in_array($lang, ['fr', 'en', 'ar', 'es'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('locale.switch');

// ── Authenticated routes ──
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Rendez-vous (all roles) ──
    Route::get('/rendezvous', [RendezvousController::class, 'index'])->name('rendezvous.index');
    Route::post('/rendezvous', [RendezvousController::class, 'store'])->name('rendezvous.store');
    Route::put('/rendezvous/{rendezvou}', [RendezvousController::class, 'update'])->name('rendezvous.update');
    Route::delete('/rendezvous/{rendezvou}', [RendezvousController::class, 'destroy'])->name('rendezvous.destroy');
    Route::patch('/rendezvous/{rendezvou}/cancel', [RendezvousController::class, 'cancel'])->name('rendezvous.cancel');

    // ── Admin-only actions ──
    Route::middleware('role:admin')->group(function () {
        Route::patch('/rendezvous/{rendezvou}/confirm', [RendezvousController::class, 'confirm'])->name('rendezvous.confirm');

        // Services CRUD (admin only)
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    });
});

require __DIR__.'/auth.php';
