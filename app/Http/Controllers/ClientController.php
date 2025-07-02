<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\DriverProfile;
use App\Models\Rating;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientController extends Controller
{
    public function showBookingForm()
    {
        return view('client.book');
    }

    public function submitBooking(Request $request)
    {
        $validated = $request->validate([
            'pickup_address' => 'required|string',
            'dropoff_address' => 'required|string',
            'package_description' => 'required|string',
            'scheduled_time' => 'required|date',
            'contact_number' => 'required|string',
        ]);

        Job::create([
            'client_id' => Auth::id(),
            'pickup_address' => $validated['pickup_address'],
            'dropoff_address' => $validated['dropoff_address'],
            'package_description' => $validated['package_description'],
            'scheduled_time' => $validated['scheduled_time'],
            'contact_number' => $validated['contact_number'],
            'status' => 'Pending Assignment',
        ]);

        return redirect()->route('client.requests')->with('success', 'Delivery booked successfully.');
    }

    public function myRequests()
    {
        $jobs = Job::with('driver')
            ->where('client_id', Auth::id())
            ->get();

        return view('client.requests', compact('jobs'));
    }

    public function trackStatus()
    {
        $jobs = Job::with('driver')
            ->where('client_id', Auth::id())
            ->get();

        return view('client.track', compact('jobs'));
    }

    public function jobHistory()
    {
        $jobs = Job::with('driver', 'rating')
            ->where('client_id', Auth::id())
            ->where('status', 'Delivered')
            ->get();

        return view('client.history', compact('jobs'));
    }

    public function downloadReceipt(Job $job)
    {
        if ($job->client_id !== Auth::id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('client.receipt', compact('job'));
        return $pdf->download('receipt-' . $job->id . '.pdf');
    }
}