@extends('layouts.driver')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Set Availability Status') }}
        </h2>
    </x-slot>

    <div class="max-w-xl p-6 mx-auto mt-6 bg-white rounded shadow">
        @if(session('success'))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
        @elseif(session('error'))
        <div class="p-3 mb-4 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('driver.availability.set') }}" class="p-6 bg-white rounded shadow">
            @csrf

            <label for="availability_status" class="block mb-2 font-medium">Availability Status</label>
            <select name="availability_status" id="availability_status" class="w-full p-2 mb-4 border rounded">
                <option value="Available" {{ $driver->availability_status === 'Available' ? 'selected' : '' }}>Available
                </option>
                <option value="On Delivery" {{ $driver->availability_status === 'On Delivery' ? 'selected' : '' }}>On
                    Delivery</option>
                <option value="Off Duty" {{ $driver->availability_status === 'Off Duty' ? 'selected' : '' }}>Off Duty
                </option>
            </select>

            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Save</button>
        </form>

    </div>
</x-app-layout>