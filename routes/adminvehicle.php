<?php

use App\Http\Controllers\Admin\VehicleNiAsh;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\JobController;


 Route::prefix('vehicleniash')->name('vehicleniash.')->group(function () {
        Route::get('/index', [VehicleNiAsh::class, 'index'])->name('vehicleniash.index');
        Route::get('/vehicle/register/{id}', [VehicleNiAsh::class, 'create'])->name('vehicle.create');
        Route::post('/vehicle/register', [VehicleNiAsh::class, 'store'])->name('vehicle.store');
    });