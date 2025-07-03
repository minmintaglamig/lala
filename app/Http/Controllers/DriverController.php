<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\DriverProfile;
use App\Models\Job;
use Carbon\Carbon;

class DriverController extends Controller
{
    // ===================== ADMIN METHODS =====================

    // Admin: List all drivers
    public function index(Request $request)
    {
        $query = DriverProfile::query();

        if ($request->filled('user_id')) {
            $query->where('user_id', 'like', '%' . $request->user_id . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }


        $drivers = $query->paginate(10);

        return view('admin.driver.index', compact('drivers'));
    }


    // Admin: form (basic info)
    public function createdriverinfo()
    {
        return view('admin.drivers.create');
    }

    // Admin:  info (basic info)
    public function storeDriverInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
        ]);

        if (!empty($validated['date_of_birth'])) {
            $validated['age'] = Carbon::parse($validated['date_of_birth'])->age;
        }



        $driver = DriverProfile::create($validated);

        return redirect()->route('admin.drivers.moreinfo', $driver->id);
    }

    // Admin: form (additional info)
    public function createdrivermoreinfo($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.drivers.moreinfo', compact('driver'));
    }

    // Admin:  additional info
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

        return redirect()->route('admin.drivers.index')->with('success', 'Driver info updated!');
    }

    // Admin: View driver
    public function view($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.index', compact('drivers'));

    }

    // Admin: Edit driver
    public function editDriver($id)
    {
        $driver = DriverProfile::findOrFail($id);
        return view('admin.driver.edit', compact('driver'));
    }

    // Admin: Update driver
    public function updateDriver(Request $request, $id)
    {
        $driver = DriverProfile::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer',
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

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully!');
    }

    // Admin: Delete driver
    public function destroy($id)
    {
        $driver = DriverProfile::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully!');
    }

    // ===================== DRIVER METHODS =====================

    // Driver: Dashboard
    public function dashboard()
    {
        $driver = Auth::user()->driverProfile;
        return view('driver.dashboard', compact('driver'));
    }

    // Driver: Show profile
    public function show()
    {
        $driver = Auth::user()->driverProfile;
        if (!$driver) {
            return redirect()->route('driver.profile.updateDriverInfoForm')->with('error', 'No profile found. Please complete your profile.');
        }
        return view('driver.profile.show', compact('driver'));
    }

    // Driver:  update personal info
    public function edit()
    {
        $driver = Auth::user()->driverProfile;
        return view('driver.profile.updateDriverInfo', compact('driver'));
    }

    // Driver:
    public function updateDriverInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
        ]);

        if (!empty($validated['date_of_birth'])) {
            $validated['age'] = Carbon::parse($validated['date_of_birth'])->age;
        }

        session(['driver_info_step1' => $validated]);

        return redirect()->route('driver.profile.updateDriverMoreInfo');
    }

    // Driver:  additional info form
    public function showDriverMoreInfoForm()
    {
        if (!session()->has('driver_info_step1')) {
            return redirect()->route('driver.profile.updateDriverInfoForm')->with('error', 'Step 1 must be completed.');
        }

        $driver = Auth::user()->driverProfile;
        return view('driver.profile.updateDriverMoreInfo', compact('driver'));
    }

    // Driver: Save additional info
    public function updateDriverMoreInfo(Request $request)
    {
        $step1 = session('driver_info_step1');

        if (!$step1) {
            return redirect()->route('driver.profile.updateDriverInfoForm')->with('error', 'Step 1 data missing.');
        }

        if (!empty($step1['date_of_birth'])) {
            $step1['age'] = Carbon::parse($step1['date_of_birth'])->age;
        }

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

        $data = array_merge($step1, $validated);
        $data['user_id'] = Auth::id();

        DriverProfile::updateOrCreate(['user_id' => Auth::id()], $data);
        session()->forget('driver_info_step1');

        return redirect()->route('driver.profile.show')->with('success', 'Driver profile saved successfully.');
    }

        // View assigned jobs
    public function assignedJobs()
    {
        $jobs = Job::with('client')
            ->where('driver_id', Auth::id())
            ->whereIn('status', ['Pending', 'In Progress'])
            ->get();

        return view('driver.assigned-jobs', compact('jobs'));
    }

    // Location update form
    public function locationPage()
    {
        return view('driver.location');
    }

    // Save driver location
    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $driver = Auth::user()->driverProfile;
        $driver->update([
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        return back()->with('success', 'Location updated.');
    }

    // Job History for driver
    public function jobHistory()
    {
        $jobs = Job::with('rating')
            ->where('driver_id', Auth::id())
            ->where('status', 'Delivered')
            ->get();

        return view('driver.job-history', compact('jobs'));
    }

    // Availability status
    public function showAvailabilityForm()
    {
        $driver = Auth::user()->driverProfile;
        return view('driver.availability', compact('driver'));
    }

    public function setAvailability(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:Available,On Delivery,Off Duty',
        ]);

        $driver = Auth::user()->driverProfile;
        $driver->update(['availability_status' => $validated['status']]);

        return back()->with('success', 'Availability updated.');
    }
}
