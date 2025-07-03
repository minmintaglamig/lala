<?php

namespace App\Http\Controllers;

use App\Models\DriverProfile;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Vehicle;

class JobController extends Controller
{
    public function index() {
        $book = Job::all();
        return view('admin.job.index', compact('book'));
    }
    public function assign($id)
{
    // Step 1: Get all available drivers
    $availdriver = DriverProfile::where('availability_status', 'available')->get();

    if ($availdriver->isEmpty()) {
        return redirect()->back()->with('error', 'NO DRIVER AVAILABLE');
    }

    // Step 2: Extract all user_ids from the available drivers
    $userIds = $availdriver->pluck('user_id');

    // Step 3: Get all available vehicles that belong to those user_ids
    $availvehicle = Vehicle::where('status', 'available')
        ->whereIn('driver_id', $userIds)
        ->get();

    if ($availvehicle->isEmpty()) {
        return redirect()->back()->with('error', 'NO VEHICLE AVAILABLE');
    }

    return view('admin.job.assign', compact('availdriver', 'availvehicle', 'id'));
}


public function assignNow($driver_id, $book_id)
{
    $vehicle = Vehicle::where('driver_id', $driver_id)->first();
    if (!$vehicle) {
        return redirect()->back()->with('error', 'No vehicle assigned to this driver');
    }

    $driverProfile = DriverProfile::where('user_id', $driver_id)->first();
    if (!$driverProfile) {
        return redirect()->back()->with('error', 'Driver profile not found');
    }

    $job = Job::find($book_id);
    if (!$job) {
        return redirect()->back()->with('error', 'Job not found');
    }

    $job->update([
        'vehicle_id' => $vehicle->id,             
        'driver_id' => $driverProfile->id,    
        'delivery_status' => 'in_progress',
    ]);

    return redirect()->back()->with('success', 'Driver and vehicle assigned successfully!');
}

}
