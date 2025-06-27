<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationUpdate;


class LocationUpdateController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'delivery_job_id' => 'required|exists:delivery_jobs,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        LocationUpdate::create([
            'delivery_job_id' => $validated['delivery_job_id'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'timestamp' => now(),
        ]);

        return response()->json(['message' => 'Location update recorded successfully.']);
    }

    public function index()
    {
        $jobs = \App\Models\DeliveryJob::with('locationUpdates')->get(); // optional: filter for active jobs
        return view('admin.location.index', compact('jobs'));
    }

    public function getDriverLocations()
    {
        $locations = LocationUpdate::latest()
            ->get()
            ->map(function ($location) {
                return [
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                    'driver_id' => optional($location->deliveryJob->driver)->id ?? 'Unknown',
                    'created_at' => $location->created_at,
                ];
            });

        return response()->json($locations);
    }
}