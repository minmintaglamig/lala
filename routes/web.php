<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;

Route::get('/', fn() => view('index'));

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'Admin')
        return redirect('/admin/dashboard');
    if ($user->role === 'Driver')
        return redirect('/driver/dashboard');
    return redirect('/client/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/driver/dashboard', 'driver.dashboard')->name('driver.dashboard');
    Route::view('/client/dashboard', 'client.dashboard')->name('client.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        //kay driver profiles
        Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
        Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
        Route::get('/driver/profile/edit/{user}', [DriverController::class, 'edit'])->name('driver.profile.edit');
        Route::post('/driver/profile/update/{user}', [DriverController::class, 'update'])->name('driver.profile.update');

        // kay vehicles
        Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicles.create');

        // kay jobs
        Route::view('/job', 'admin.job.index')->name('job.index');

        //kay location
        Route::view('/location', 'admin.location.index')->name('location.index');
    });
});

// sa profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::fallback(fn() => redirect('/dashboard'));
Route::resource('vehicles', VehicleController::class);