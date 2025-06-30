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
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Assuming authenticated user is a driver
        $driverProfile = DriverProfile::where('user_id', Auth::id())->first();

        if (!$driverProfile) {
            return response()->json(['error' => 'Driver profile not found.'], 404);
        }

        $location = LocationUpdate::create([
            'driver_id' => $driverProfile->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['message' => 'Location updated.', 'data' => $location]);
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