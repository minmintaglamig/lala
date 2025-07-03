<x-app-layout>
    @extends('layouts.driver')
    <x-slot name="header">

        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 bg-white rounded-lg shadow-md">

                <h2 class="mb-6 text-2xl font-bold text-gray-800">Driver Profile</h2>

                <div class="grid grid-cols-1 text-sm leading-relaxed text-gray-800 md:grid-cols-2 gap-y-4 gap-x-8">
                    <div><span class="font-semibold">Driver ID:</span> {{ $driver->user_id }}</div>
                    <div><span class="font-semibold">Name:</span> {{ $driver->name }}</div>
                    <div><span class="font-semibold">Phone:</span> {{ $driver->phone_number }}</div>
                    <div><span class="font-semibold">Email:</span> {{ $driver->email }}</div>
                    <div><span class="font-semibold">Address:</span> {{ $driver->address }}</div>
                    <div><span class="font-semibold">Date of Birth:</span> {{ $driver->date_of_birth }}</div>
                    <div><span class="font-semibold">Age:</span> {{ $driver->age }}</div>
                    <div><span class="font-semibold">Gender:</span> {{ $driver->gender }}</div>
                    <div><span class="font-semibold">Marital Status:</span> {{ $driver->marital_status }}</div>
                    <div><span class="font-semibold">Emergency Contact:</span> {{ $driver->emergency_contact }}</div>
                    <div><span class="font-semibold">License Number:</span> {{ $driver->license_number }}</div>
                    <div><span class="font-semibold">License Type:</span> {{ $driver->license_type }}</div>
                    <div><span class="font-semibold">License Expiry:</span> {{ $driver->license_expiry }}</div>
                    <div><span class="font-semibold">Vehicle Assigned:</span> {{ $driver->vehicle_assigned }}</div>
                    <div><span class="font-semibold">Route Assigned:</span> {{ $driver->route_assigned }}</div>
                    <div><span class="font-semibold">Driver Status:</span> {{ $driver->driver_status }}</div>
                    <div><span class="font-semibold">Hire Date:</span> {{ $driver->hire_date }}</div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('driver.profile.updateDriverInfoForm') }}"
                        class="inline-block px-5 py-2 text-sm font-medium text-white bg-yellow-500 rounded shadow hover:bg-yellow-600">
                        Update Personal Info
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>