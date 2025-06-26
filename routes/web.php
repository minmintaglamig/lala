<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
        Route::view('/driver', 'admin.driver.index')->name('driver.index');
        Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::view('/job', 'admin.job.index')->name('job.index');
        Route::view('/location', 'admin.location.index')->name('location.index');

    });
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::get('/drivers/{id}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::get('/drivers/{id}/view', [DriverController::class, 'view'])->name('drivers.view');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('vehicles', VehicleController::class);




