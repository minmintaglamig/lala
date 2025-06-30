<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryJob;
use App\Models\LocationUpdate;

class JobController extends Controller
{
    public function latestLocation($id)
    {
        $latest = LocationUpdate::where('delivery_job_id', $id)
            ->latest('timestamp')
            ->first();

        if (!$latest) {
            return response()->json(['message' => 'No location data found.'], 404);
        }

        return response()->json([
            'latitude' => $latest->latitude,
            'longitude' => $latest->longitude,
            'timestamp' => $latest->timestamp,
        ]);
    }

    /**
     * Update the job status (e.g., picked_up, in_transit, delivered).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,picked_up,in_transit,delivered,cancelled',
        ]);

        $job = DeliveryJob::findOrFail($id);
        $job->status = $request->status;
        $job->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

    /**
     * Optional: Show the map view for tracking the job
     */
    public function viewMap($id)
    {
        $job = DeliveryJob::with('locationUpdates')->findOrFail($id);
        return view('delivery_jobs.track', compact('job'));
    }

    public function index()
    {
        $jobs = DeliveryJob::with(['client', 'driver'])->get();
        return view('jobs.index', compact('jobs'));
    }
}