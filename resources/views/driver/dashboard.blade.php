@extends('layouts.driver')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Driver Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Greeting --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-red-600">
                    Hey {{ Auth::user()->name }}
                </h1>
                <p class="text-sm text-gray-600">
                    You are logged in as <span class="font-medium">{{ Auth::user()->role ?? 'Driver' }}</span>
                </p>
            </div>

            {{-- Availability --}}
            <div class="p-6 mb-8 bg-white border-l-4 border-blue-500 shadow rounded-xl">
                <h3 class="mb-2 text-lg font-semibold text-gray-800">Your Availability</h3>

                @php
                $status = $availability_status ?? 'Not Set';

                $colorMap = [
                'Available' => 'text-green-600',
                'On Delivery' => 'text-yellow-600',
                'Off Duty' => 'text-gray-500',
                'Not Set' => 'text-gray-400'
                ];

                $colorClass = $colorMap[$status] ?? 'text-gray-400';
                @endphp

                <div class="flex items-center justify-between">
                    <p class="text-gray-700">
                        Status:
                        <span class="font-bold {{ $colorClass }}">
                            {{ $status }}
                        </span>
                    </p>

                    <a href="{{ route('driver.availability') }}" class="text-sm text-blue-600 hover:underline">
                        Change Status
                    </a>
                </div>
            </div>

            {{-- Add more widgets or cards below if needed --}}
            {{-- Example: Assigned Jobs, Job History, etc. --}}

        </div>
    </div>
</x-app-layout>