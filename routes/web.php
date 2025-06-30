<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationUpdateController;

Route::get('/', fn() => view('index'));

// Dashboard redirect logic
Route::get('/dashboard', function () {
    $user = Auth::user();

    $role = strtolower(trim($user->role)); // Clean and lower the role

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'driver') {
        return redirect()->route('driver.dashboard');
    } elseif ($role === 'client') {
        return redirect()->route('client.dashboard');
    } else {
        abort(403, 'Unauthorized role.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

    // Main dashboards
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/driver/dashboard', 'driver.dashboard')->name('driver.dashboard');
    Route::view('/client/dashboard', 'client.dashboard')->name('client.dashboard');

    // ---------------------
    // Admin Routes
    // ---------------------
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
        Route::get('/driver/create', [DriverController::class, 'createdriverinfo'])->name('driver.create');
        Route::post('/driver', [DriverController::class, 'storedriverinfo'])->name('driver.store');
        Route::get('/driver/{id}/moreinfo', [DriverController::class, 'createdrivermoreinfo'])->name('driver.drivermoreinfo');
        Route::post('/driver/{id}/moreinfo', [DriverController::class, 'storeMoreInfo'])->name('driver.storemoreinfo');
        Route::get('/driver/{id}/edit', [DriverController::class, 'editDriver'])->name('driver.edit');
        Route::put('/driver/{id}', [DriverController::class, 'updateDriver'])->name('driver.update');
        Route::delete('/driver/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');

        //driver location
        // For submitting location (Driver only)
        Route::post('/driver/location/update', [LocationUpdateController::class, 'store'])->middleware('auth');

        // For fetching latest location of a driver
        Route::get('/driver/{driver}/location', [LocationUpdateController::class, 'latest'])->middleware('auth');

        // kay vehicles
        Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');

        // Location Page (Leaflet)
        Route::get('/location', [LocationUpdateController::class, 'index'])->name('location.index');

        // Delivery Jobs
        Route::get('/delivery-jobs', [JobController::class, 'index'])->name('job.index'); // ✅ FIXED route name
        Route::get('/delivery-jobs/{id}', [JobController::class, 'show'])->name('job.show');
        Route::get('/delivery-jobs/{id}/track', [JobController::class, 'viewMap'])->name('job.track');
        Route::post('/delivery-jobs/{id}/status', [JobController::class, 'updateStatus'])->name('job.status.update');
        Route::get('/delivery-jobs/{id}/latest-location', [JobController::class, 'latestLocation'])->name('job.latestLocation');

        // try dynamic loc
        Route::get('/location', [LocationUpdateController::class, 'index'])->name('location.index');
        Route::get('/location/markers', [LocationUpdateController::class, 'getDriverLocations'])->name('location.markers');
    });

    // Driver sends location
    Route::post('/driver/location-update', [LocationUpdateController::class, 'store'])->name('driver.location.store');

});

// ---------------------
// Profile routes
// ---------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route for drivers to use LocUpdate Form
Route::get('driver/send-location', function () {
    return view('driver.send-location');
})->middleware('auth')->name('driver.location.form');

Route::post('/driver/location/update', [LocationUpdateController::class, 'store'])
    ->middleware('auth')
    ->name('driver.location.store');

// Auth routes
require __DIR__ . '/auth.php';

// Fallback & Vehicle Resource
Route::fallback(fn() => redirect('/dashboard'));
Route::resource('vehicles', VehicleController::class);
