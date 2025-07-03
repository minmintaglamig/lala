<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\User;

class VehicleNiAsh extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        $driverprofile = User::where('role', 'Driver')->get();
        return view("admin/driver_adminside/index", compact('vehicles', 'driverprofile'));
    }
        public function create($id)
    {
        $driver_id = $id;
        return view('admin/driver_adminside/vehicle-register', compact('driver_id'));
    }
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

        return redirect()->route('dashboard')->with('success', 'Vehicle registered successfully!');
    }
}
