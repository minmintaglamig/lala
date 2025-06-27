<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DriverProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DriverController extends Controller
{
    public function createdriverinfo()
    {
        return view('admin.driver.driverinfo');
    }

    public function storedriverinfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
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
        $validated['created_by'] = Auth::id();

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

    public function view($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.view', compact('driver'));
    }

    public function index(Request $request)
    {
        $query = DriverProfile::query();

        if ($request->filled('driver_id')) {
            $query->where('driver_id', 'like', '%' . $request->driver_id . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Pagination: Fetch 10 records per page
        $drivers = $query->paginate(10);

        return view('admin.driver.index', compact('drivers'));
    }

    public function edit()
    {
        $user = Auth::user();

        // Check if the user has an associated driver profile
        if (!$user->driverProfile) {
            return redirect()->back()->with('error', 'Driver profile not found.');
        }

        return view('driver.edit', [
            'user' => $user,
            'profile' => $user->driverProfile,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user->driverProfile) {
            return redirect()->back()->with('error', 'Driver profile not found.');
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'license_number' => 'nullable|string',
            'license_expiry' => 'nullable|date',
            'license_type' => 'nullable|string',
            'vehicle_assigned' => 'nullable|string',
            'route_assigned' => 'nullable|string',
            'license_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

        $user->driverProfile->update($validated);

        return redirect()->route('dashboard')->with('success', 'Driver profile updated successfully!');
    }

    public function editDriver($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.edit', compact('driver'));
    }

    public function updateDriver(Request $request, $id)
    {
        $driver = DriverProfile::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'license_number' => 'nullable|string',
            'license_expiry' => 'nullable|date',
            'license_type' => 'nullable|string',
            'vehicle_assigned' => 'nullable|string',
            'route_assigned' => 'nullable|string',
            'license_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'medical_cert_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'drug_test_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $driver->update($validated);

        return redirect()->route('admin.driver.index')->with('success', 'Driver updated successfully!');
    }

    public function destroy($id)
    {
        $driver = DriverProfile::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.driver.index')->with('success', 'Driver deleted successfully!');
    }
}
