<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\JobController;

 Route::prefix('job')->name('job.')->group(function () {
        Route::get('/index', [JobController::class, 'index'])->name('job.index');
        Route::get('/driver/assign/{id}', [JobController::class, 'assign'])->name('driver.assign');
        Route::get('/assign-now/{user_id}/{book_id}/{vehicle_id}', [JobController::class, 'assignNow'])->name('assignnow.store');

    });

Route::prefix('clientbooking')->name('clientbooking.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::post('/book', [ClientController::class, 'storeBooking'])->name('book.store');
});