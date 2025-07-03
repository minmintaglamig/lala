<x-app-layout>
    @extends('layouts.driver')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Driver Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="mb-6 text-3xl font-bold text-[#EA2F14]">
                Welcome, {{ Auth::user()->name }} ({{ Auth::user()->role ?? 'Driver' }})
            </div>

            {{-- Status Panel --}}
            <div class="p-6 mb-6 bg-white rounded-lg shadow">
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Your Current Status</h3>
                <p class="text-gray-700">You are currently logged in as a driver.</p>
                <p class="text-gray-700">Please ensure your profile is up to date.</p>
            </div>

            {{-- Optional Quick Stats Cards --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="p-4 bg-blue-100 rounded shadow">
                    <h4 class="text-sm font-semibold text-blue-900">Profile Status</h4>
                    <p class="text-lg font-bold text-blue-800">✔ Updated</p>
                </div>
                <div class="p-4 bg-green-100 rounded shadow">
                    <h4 class="text-sm font-semibold text-green-900">License</h4>
                    <p class="text-lg font-bold text-green-800">Valid</p>
                </div>
                <div class="p-4 bg-yellow-100 rounded shadow">
                    <h4 class="text-sm font-semibold text-yellow-900">Vehicle Assigned</h4>
                    <p class="text-lg font-bold text-yellow-800">Truck #14</p>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="mt-8">
                <a href="{{ route('driver.profile.updateDriverInfoForm') }}"
                    class="inline-block px-5 py-2 text-sm font-medium text-white bg-yellow-500 rounded shadow hover:bg-yellow-600">
                    Update Personal Info
                </a>
            </div>
        </div>
    </div>
</x-app-layout>