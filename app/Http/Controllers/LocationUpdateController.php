<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationUpdate;
use App\Models\DriverProfile;
use Illuminate\Support\Facades\Auth;

class LocationUpdateController extends Controller
{
    // Store location update from driver
    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'driver_id' => 'required|exists:driver_profiles,id',
            'delivery_job_id' => 'nullable|exists:delivery_jobs,id',
        ]);

        $location = LocationUpdate::create($validated);

        return response()->json([
            'message' => 'Location stored successfully.',
            'data' => $location
        ]);
    }

    // Fetch the latest location of a driver (for Admin/Client)
    public function latest($driverId)
    {
        $location = LocationUpdate::where('driver_id', $driverId)
            ->latest()
            ->first();

        if (!$location) {
            return response()->json(['error' => 'No location found'], 404);
        }

        return response()->json($location);
    }

    public function index()
    {
        return view('location.index');
    }

}