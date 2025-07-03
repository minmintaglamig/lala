@extends('layouts.driver')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('DriverProfile') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl p-6 mx-auto bg-white shadow-md rounded-xl">
        <h2 class="mb-6 text-2xl font-bold">Driver Additional Information</h2>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="p-3 mb-4 text-green-800 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="p-3 mb-4 text-red-800 bg-red-100 rounded">
            <ul class="ml-5 list-disc">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Step Navigation --}}
        <div class="flex justify-center mb-6 space-x-4">
            <span
                class="px-4 py-2 rounded {{ Request::routeIs('driver.profile.updateDriverInfo') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                Personal Info
            </span>
            <span
                class="px-4 py-2 rounded {{ Request::routeIs('driver.profile.updateDriverMoreInfo') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                Additional Info
            </span>
        </div>

        <form action="{{ route('driver.profile.updateDriverMoreInfo') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Personal Info Preview --}}
            <div class="p-4 rounded bg-blue-50">
                <h3 class="mb-2 text-lg font-semibold">Personal Information</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div><strong>Full Name:</strong> {{ $driver->name }}, {{ $driver->first_name }} {{
                        $driver->middle_name }} {{ $driver->suffix }}</div>
                    <div><strong>Contact:</strong> {{ $driver->phone_number }}</div>
                    <div><strong>Email:</strong> {{ $driver->email ?? 'N/A' }}</div>
                    <div><strong>Address:</strong> {{ $driver->address ?? 'N/A' }}</div>
                    <div><strong>Date of Birth:</strong> {{ optional($driver->date_of_birth)->format('F d, Y') ?? 'N/A'
                        }}</div>
                </div>
            </div>

            {{-- License Section --}}
            <div>
                <h4 class="mb-2 text-xl font-semibold">License & Legal</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block font-medium">License Number</label>
                        <input type="text" name="license_number"
                            value="{{ old('license_number', $driver->license_number) }}"
                            class="w-full px-3 py-2 mt-1 border rounded">
                    </div>
                    <div>
                        <label class="block font-medium">License Expiry</label>
                        <input type="date" name="license_expiry"
                            value="{{ old('license_expiry', $driver->license_expiry) }}"
                            class="w-full px-3 py-2 mt-1 border rounded">
                    </div>
                    <div>
                        <label class="block font-medium">License Type</label>
                        <select name="license_type" onchange="updateVehicleOptions()"
                            class="w-full px-3 py-2 mt-1 border rounded">
                            <option value="">-- Select License Type --</option>
                            @foreach([
                            'Student Permit','Non-Prof A (Motorcycle)','Non-Prof A1 (Tricycles)','Non-Prof B (Light
                            Vehicles)',
                            'Prof A (Motorcycle)','Prof A1 (Tricycles)','Prof B (Light Vehicles)','Prof B1 (Heavy
                            Vehicles)','Prof B2 (Articulated)'
                            ] as $type)
                            <option value="{{ $type }}" {{ old('license_type', $driver->license_type) == $type ?
                                'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">Additional Permits</label>
                        <input type="text" name="additional_permits"
                            value="{{ old('additional_permits', $driver->additional_permits) }}"
                            class="w-full px-3 py-2 mt-1 border rounded">
                    </div>
                    <div class="col-span-2">
                        <label class="block font-medium">License Image</label>
                        <input type="file" name="license_image" class="w-full px-3 py-2 mt-1 border rounded">
                        @if($driver->license_image)
                        <img src="{{ asset('storage/' . $driver->license_image) }}"
                            class="w-40 h-auto mt-2 border rounded">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Work Info --}}
            <div>
                <h4 class="mb-2 text-xl font-semibold">Work Info</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block font-medium">Driver ID</label>
                        <input type="text" name="user_id" value="{{ $driver->user_id }}" readonly
                            class="w-full px-3 py-2 mt-1 bg-gray-100 border rounded">
                    </div>
                    <div>
                        <label class="block font-medium">Driver Status</label>
                        <select name="driver_status" class="w-full px-3 py-2 mt-1 border rounded">
                            @foreach(['full-time', 'part-time', 'contract'] as $status)
                            <option value="{{ $status }}" {{ old('driver_status', $driver->driver_status) === $status ?
                                'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">Hire Date</label>
                        <input type="date" name="hire_date" value="{{ old('hire_date', $driver->hire_date) }}"
                            class="w-full px-3 py-2 mt-1 border rounded">
                    </div>
                    <div>
                        <label class="block font-medium">Vehicle Assigned</label>
                        <input type="text" name="vehicle_assigned"
                            value="{{ old('vehicle_assigned', $driver->vehicle_assigned) }}"
                            class="w-full px-3 py-2 mt-1 border rounded">
                    </div>
                    <div>
                        <label class="block font-medium">Route Assigned</label>
                        <input type="text" name="route_assigned"
                            value="{{ old('route_assigned', $driver->route_assigned) }}"
                            class="w-full px-3 py-2 mt-1 border rounded">
                    </div>
                </div>
            </div>

            {{-- Health & Safety --}}
            <div>
                <h4 class="mb-2 text-xl font-semibold">Health & Safety</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block font-medium">Medical Certificate</label>
                        <input type="file" name="medical_cert_file" class="w-full px-3 py-2 mt-1 border rounded">
                        @if($driver->medical_cert_file)
                        <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank"
                            class="block mt-1 text-blue-600 underline">View Uploaded File</a>
                        @endif
                    </div>
                    <div>
                        <label class="block font-medium">Drug Test Result</label>
                        <input type="file" name="drug_test_file" class="w-full px-3 py-2 mt-1 border rounded">
                        @if($driver->drug_test_file)
                        <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank"
                            class="block mt-1 text-blue-600 underline">View Uploaded File</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex mt-6 space-x-4">
                <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">Save Driver
                    Info</button>
                <a href="{{ url('/vehicles/assign/' . $driver->driver_id) }}"
                    class="px-6 py-2 text-blue-600 border border-blue-500 rounded hover:bg-blue-50">Vehicle</a>
            </div>
        </form>
    </div>

    <script>
        function updateVehicleOptions() {
            const licenseType = document.querySelector('select[name="license_type"]').value;
            const vehicleInput = document.querySelector('input[name="vehicle_assigned"]');

            const vehicleOptions = {
                'Student Permit': '',
                'Non-Prof A (Motorcycle)': 'Motorcycle',
                'Non-Prof A1 (Tricycles)': 'Tricycle',
                'Non-Prof B (Light Vehicles)': 'Car, SUV, Pickup',
                'Prof A (Motorcycle)': 'Motorcycle',
                'Prof A1 (Tricycles)': 'Tricycle',
                'Prof B (Light Vehicles)': 'Car, SUV, Pickup',
                'Prof B1 (Heavy Vehicles)': 'Truck, Bus',
                'Prof B2 (Articulated)': 'Trailer Truck, Articulated Vehicle'
            };

            vehicleInput.value = vehicleOptions[licenseType] || '';
        }
    </script>
</x-app-layout>