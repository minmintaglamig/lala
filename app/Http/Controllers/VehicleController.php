<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\DriverProfile;
use Illuminate\Support\Facades\Auth;
 // Assuming you're using this model for driver list

class VehicleController extends Controller
{


public function index()
{
    // Get the logged-in user
    $user = Auth::user();

    // If the user is an admin, show all vehicles
    if ($user->role === 'admin') {
        $vehicles = Vehicle::all();
    } else {
        // For non-admin users, find their driver profile
        $driver = DriverProfile::where('user_id', $user->id)->first();

        if (!$driver) {
            return redirect()->back()->with('error', 'Driver profile not found.');
        }

        // Fetch only the vehicles belonging to that driver
        $vehicles = Vehicle::where('driver_id', $driver->id)->get();
    }

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
        return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle registered successfully!');

    }

    public function edit($id)
    {
    $vehicle = Vehicle::findOrFail($id);
    return view('admin.vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'plate_number' => 'required|string',
        'type' => 'required|string',
        'model' => 'required|string',
        'capacity' => 'required|numeric',
        'status' => 'required|string',
    ]);

    $vehicle = Vehicle::findOrFail($id);
    $vehicle->update($request->all());

    return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle updated successfully.');
}
    public function destroy($id)
{
    $vehicle = Vehicle::findOrFail($id);
    $vehicle->delete();

    return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle deleted successfully.');
}
}