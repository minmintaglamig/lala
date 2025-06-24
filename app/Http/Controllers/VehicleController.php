<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|integer',
            'plate_number' => 'required|string|unique:vehicles',
            'model' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|string',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle registered successfully!');
    }

    // other methods like index(), create(), etc.
}
