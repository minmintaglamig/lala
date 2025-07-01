<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;

// Public Route
Route::get('/', fn() => view('index'));

// Redirect Based on Role After Login
Route::get('/dashboard', function () {
    $role = strtolower(trim(Auth::user()->role));

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'driver' => redirect()->route('driver.dashboard'),
        'client' => redirect()->route('client.dashboard'),
        default => abort(403, 'Unauthorized role.'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated and Verified Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // --- Admin Routes ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        // Driver Management
        Route::get('/driver', [DriverController::class, 'index'])->name('admin.driver.index');

        Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
        Route::get('/driver/create', [DriverController::class, 'createdriverinfo'])->name('driver.create');
        Route::post('/driver', [DriverController::class, 'storedriverinfo'])->name('driver.store');
        Route::get('/driver/{id}/moreinfo', [DriverController::class, 'createdrivermoreinfo'])->name('driver.drivermoreinfo');
        Route::post('/driver/{id}/moreinfo', [DriverController::class, 'storeMoreInfo'])->name('driver.storemoreinfo');
        Route::get('/driver/{id}/edit', [DriverController::class, 'editDriver'])->name('driver.edit');
        Route::put('/driver/{id}', [DriverController::class, 'updateDriver'])->name('driver.update');
        Route::delete('/driver/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');

        // Vehicle Management
        Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicles.create');

        // Job and Location Pages
        Route::view('/job', 'admin.job.index')->name('job.index');
        Route::view('/location', 'admin.location.index')->name('location.index');
    });

    // --- Driver Routes ---
    Route::prefix('driver')->name('driver.')->group(function () {
        Route::view('/dashboard', 'driver.dashboard')->name('dashboard');

        // Profile Update Steps
        Route::get('/profile/info', [DriverController::class, 'edit'])->name('profile.updateDriverInfoForm');
        Route::post('/profile/info', [DriverController::class, 'updateDriverInfo'])->name('profile.updateDriverInfo');
        Route::get('/profile/more-info', [DriverController::class, 'showDriverMoreInfoForm'])->name('profile.updateDriverMoreInfo');
        Route::post('/profile/more-info', [DriverController::class, 'updateDriverMoreInfo'])->name('profile.updateDriverMoreInfo');

        // View Profile
        Route::get('/profile', [DriverController::class, 'show'])->name('profile.show');
    });

    // --- Client Dashboard (if applicable) ---
    Route::view('/client/dashboard', 'client.dashboard')->name('client.dashboard');
});

// --- User Profile Settings ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Scaffolding Routes (from Laravel Breeze/Fortify/etc.)
require __DIR__ . '/auth.php';

// Fallback Route
Route::fallback(fn() => redirect('/dashboard'));

// Resource Route for VehicleController (optional, may conflict with custom routes)
Route::resource('vehicles', VehicleController::class);
