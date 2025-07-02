<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\JobController;

Route::get('/', fn() => view('index'));

Route::get('/dashboard', function () {
    $role = strtolower(trim(Auth::user()->role));

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'driver' => redirect()->route('driver.dashboard'),
        'client' => redirect()->route('client.dashboard'),
        default => abort(403, 'Unauthorized role.'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    // ADMIN ROUTES
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        // Driver Management
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

    // DRIVER ROUTES
    Route::prefix('driver')->name('driver.')->group(function () {
        Route::view('/dashboard', 'driver.dashboard')->name('dashboard');

        // Profile
        Route::get('/profile', [DriverController::class, 'show'])->name('profile.show');
        Route::get('/profile/info', [DriverController::class, 'edit'])->name('profile.updateDriverInfoForm');
        Route::post('/profile/info', [DriverController::class, 'updateDriverInfo'])->name('profile.updateDriverInfo');
        Route::get('/profile/more-info', [DriverController::class, 'showDriverMoreInfoForm'])->name('profile.updateDriverMoreInfo');
        Route::post('/profile/more-info', [DriverController::class, 'updateDriverMoreInfo'])->name('profile.updateDriverMoreInfo');

        // Assigned Jobs
        Route::get('/assigned-jobs', [DriverController::class, 'assignedJobs'])->name('assignedjobs');

        // Location Update
        Route::get('/location', [DriverController::class, 'locationPage'])->name('location');
        Route::post('/location/update', [DriverController::class, 'updateLocation'])->name('location.update');

        // Availability Status
        Route::get('/availability', [DriverController::class, 'showAvailabilityForm'])->name('availability');
        Route::post('/availability', [DriverController::class, 'setAvailability'])->name('availability.set');

        // Job History
        Route::get('/job-history', [DriverController::class, 'jobHistory'])->name('history');
    });

    // CLIENT ROUTES
    Route::prefix('client')->name('client.')->group(function () {
        Route::view('/dashboard', 'client.dashboard')->name('dashboard');

        // Book a Delivery
        Route::get('/book', [ClientController::class, 'showBookingForm'])->name('book');
        Route::post('/book', [ClientController::class, 'submitBooking'])->name('book.submit');

        // View My Requests
        Route::get('/requests', [ClientController::class, 'myRequests'])->name('requests');

        // Track Delivery Status
        Route::get('/track', [ClientController::class, 'trackStatus'])->name('track');

        // Job History & Receipts
        Route::get('/history', [ClientController::class, 'jobHistory'])->name('history');
        Route::get('/receipt/{job}', [ClientController::class, 'downloadReceipt'])->name('receipt.download');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::fallback(fn() => redirect('/dashboard'));
Route::resource('vehicles', VehicleController::class);