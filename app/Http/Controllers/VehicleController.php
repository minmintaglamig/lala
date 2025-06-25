<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\DriverProfile;
use Illuminate\Support\Facades\Auth;
 // Assuming you're using this model for driver list

class VehicleController extends Controller
{
    // Show the list of all vehicles
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicle.index', compact('vehicles'));
    }

    // Show the form to register a new vehicle
    public function create()
    {
    $user = Auth::user();
    $driver = DriverProfile::where('user_id', $user->id)->first();

    if (!$driver) {
        return redirect()->back()->with('error', 'Driver profile not found.');
    }

    return view('admin.vehicle.vehicleregister', ['driverId' => $driver->id]);
    }


    // Handle vehicle form submission
    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:driver_profiles,id',
            'plate_number' => 'required|string|unique:vehicles',
            'model' => 'required|string',
            'type' => 'required|string',
            'capacity' => 'required|integer',
            'status' => 'required|string',
        ]);

        Vehicle::create($request->all());
        return redirect()->route('vehicles.index')->with('success', 'Vehicle registered successfully!');
    }
}
