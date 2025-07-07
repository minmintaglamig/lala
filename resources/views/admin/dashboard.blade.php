@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h3 class="text-sm text-gray-500 mb-1">Total Orders</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalorders }}</p>
            <p class="text-xs text-gray-400 mt-2">This month</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h3 class="text-sm text-gray-500 mb-1">Active Drivers</h3>
            <p class="text-3xl font-bold text-green-500">{{ $activedriver }}</p>
            <p class="text-xs text-gray-400 mt-2">Live now</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h3 class="text-sm text-gray-500 mb-1">Pending Orders</h3>
            <p class="text-3xl font-bold text-yellow-500">{{ $pendingorder }}</p>
            <p class="text-xs text-gray-400 mt-2">Live now</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h3 class="text-sm text-gray-500 mb-1">Cancelled Deliveries</h3>
            <p class="text-3xl font-bold text-red-500">{{ $cancelledorder }}</p>
            <p class="text-xs text-gray-400 mt-2">This week</p>
        </div>

        <div class="col-span-1 lg:col-span-4 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Delivery Map Overview</h2>
            <div id="jobsMap" class="h-80 rounded-lg z-0"></div>
            <p class="text-sm text-gray-500 mt-4">
                <span class="text-blue-600 font-medium">All</span> delivery
            </p>
        </div>
        @include('driver.assignedjobs_components.alljobsjs')


        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
            <ul class="text-sm text-gray-600 space-y-2 max-h-64 overflow-y-auto">

            </ul>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Driver Performance</h2>
            <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-sm">
                BORIKAAAT
            </div>
        </div>

    </div>
@endsection
