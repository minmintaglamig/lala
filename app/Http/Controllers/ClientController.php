<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\DriverProfile;
use App\Models\Rating;
use App\Models\User;
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
            'driver_id' => null,
            'vehicle_id' => null,
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
            ->where('delivery_status', 'delivered')
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




    // FOR JOB BOOKING

    public function storeBooking(Request $request){
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'client_name'=> 'required|string|max:255',
            'client_contact' => 'required|string|max:15',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:50',
            'distance_km'=> 'required',
            'price_php'=> 'required',
            'package_description' => 'required|string|max:255',
            'scheduled_time' => 'required',
            'pickup_latitude' => 'string|max:255',
            'pickup_longitude' => 'string|max:255',
            'dropoff_latitude' => 'string|max:255',
            'dropoff_longitude' => 'string|max:255',
        ]);

        Job::create([
            'client_id'=> $request->client_id,
            'client_name'=> $request->client_name,
            'client_contact'=> $request->client_contact,
            'pickup_address'=> $request->pickup_address,
            'dropoff_address'=> $request->dropoff_address,
            'vehicle_type'=> $request->vehicle_type,
            'distance'=> $request->distance_km,
            'price'=> $request->price_php,
            'package_description'=> $request->package_description,
            'scheduled_time'=> $request->scheduled_time,
            'pickup_latitude' => $request->pickup_latitude,
            'pickup_longitude' => $request->pickup_longitude,
            'dropoff_latitude' => $request->dropoff_latitude,
            'dropoff_longitude' => $request->dropoff_longitude,
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Booking successfully created!');
    }
}