<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DriverProfile;
use Carbon\Carbon;

class DriverController extends Controller
{
    public function createdriverinfo()
    {
        return view('admin.driver.driverinfo');
    }

    public function index(Request $request)
    {
        $query = DriverProfile::query();

        if ($request->filled('driver_id')) {
            $query->where('driver_id', 'like', '%' . $request->driver_id . '%');
        }

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        $driver = $query->get();

        return view('admin.driver.index', compact('driver'));
    }

    public function edit($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.drivermoreinfo', compact('driver'));
    }

    public function view($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.view', compact('driver'));
    }

    public function storedriverinfo(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'suffix' => 'nullable|string',
            'contact_number' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
        ]);

        if (!empty($validated['date_of_birth'])) {
            $dob = Carbon::parse($validated['date_of_birth']);
            $validated['age'] = $dob->age;
        }

        $validated['driver_id'] = 'DRV-' . strtoupper(Str::random(6));

        $driver = DriverProfile::create($validated);

        return redirect()->route('admin.driver.drivermoreinfo', $driver->id);
    }

    public function createdrivermoreinfo($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.drivermoreinfo', compact('driver'));
    }

    public function storeMoreInfo(Request $request, $id)
    {
        $driver = DriverProfile::findOrFail($id);

        $validated = $request->validate([
            'license_number' => 'nullable|string',
            'license_expiry' => 'nullable|date',
            'license_type' => 'nullable|string',
            'additional_permits' => 'nullable|string',
            'license_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'driver_status' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'vehicle_assigned' => 'nullable|string',
            'route_assigned' => 'nullable|string',
            'medical_cert_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'drug_test_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('license_image')) {
            $validated['license_image'] = $request->file('license_image')->store('licenses', 'public');
        }

        if ($request->hasFile('medical_cert_file')) {
            $validated['medical_cert_file'] = $request->file('medical_cert_file')->store('medical', 'public');
        }

        if ($request->hasFile('drug_test_file')) {
            $validated['drug_test_file'] = $request->file('drug_test_file')->store('drugs', 'public');
        }

        $driver->update($validated);

        return redirect()->route('admin.driver.index')->with('success', 'Driver Info Updated!');
    }
}