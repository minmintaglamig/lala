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
    // Step 1: Create Driver Info (Admin Only)
    public function createdriverinfo()
    {
        return view('admin.driver.driverinfo');
    }

    // Step 2: Save Driver Info (Admin Only)
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

        // Calculate age if date_of_birth is provided
        if (!empty($validated['date_of_birth'])) {
            $dob = Carbon::parse($validated['date_of_birth']);
            $validated['age'] = $dob->age;
        }

        // Generate unique driver ID
        $validated['driver_id'] = 'DRV-' . strtoupper(Str::random(6));

        // Attach creator/admin user ID
        $validated['created_by'] = Auth::id();

        // Save driver profile
        $driver = DriverProfile::create($validated);

        return redirect()->route('admin.driver.drivermoreinfo', $driver->id);
    }

    // Step 3: Edit Driver More Info (Admin Only)
    public function createdrivermoreinfo($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.drivermoreinfo', compact('driver'));
    }

    // Step 4: Store More Info (Admin Only)
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

        // File uploads
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

    // View Driver Details (Admin Only)
    public function view($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.view', compact('driver'));
    }

    // Search and List Drivers (Admin Only)
    public function index(Request $request)
    {
        $query = DriverProfile::query();

        if ($request->filled('driver_id')) {
            $query->where('driver_id', 'like', '%' . $request->driver_id . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $drivers = $query->get();

        return view('admin.driver.index', compact('drivers'));
    }

    // Driver Self-Edit Profile (Driver Role)
    public function edit()
    {
        $user = Auth::user();

        return view('driver.edit-profile', [
            'user' => $user,
            'profile' => $user->driverProfile,
        ]);
    }

    // Driver Self-Update Profile (Driver Role)
    public function update(Request $request)
    {
        $user = Auth::user();

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

        // File uploads
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

    // Admin Delete Driver
    public function destroy($id)
    {
        $driver = DriverProfile::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.driver.index')->with('success', 'Driver deleted successfully!');
    }
}
