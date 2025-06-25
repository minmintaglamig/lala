<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\DriverProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
 // Assuming you're using this model for driver list

class VehicleController extends Controller
{
    // Show the list of all vehicles
    public function index()
    {
        $vehicles = Vehicle::all();
        $driverprofile = User::where('role', 'Driver')->get();
        return view('admin.vehicle.index', compact('vehicles', 'driverprofile'));
    }

    // Show the form to register a new vehicle
    public function create($id)
{
    $driver_id = $id;
    return view('admin.vehicle.vehicleregister', compact('driver_id'));
}

    // Handle vehicle form submission
    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'plate_number' => 'required',
            'model' => 'required',
            'type' => 'required',
            'capacity' => 'required',
            'status' => 'required',
        ]);

        Vehicle::create([
            'driver_id'=> $request->driver_id,
            'plate_number'=> $request->plate_number,
            'type'=> $request->type,
            'model'=> $request->model,
            'capacity'=> $request->capacity,
            'status'=> $request->status,
        ]);

        return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle registered successfully!');
    }
}
