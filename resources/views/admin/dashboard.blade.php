@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Content Area -->
    <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">

        <div class="col-span-1 lg:col-span-4 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.monthlysale')
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.drivers')
        </div>

        <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.small1')
        </div>

        <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.small2')
        </div>

        <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.small3')
        </div>

        <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.small4')
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
            @include('admin.dashboard-components.medium1')
        </div>

        <div class="col-span-1 lg:col-span-6 bg-white rounded-2xl shadow p-6 w-full hover:shadow-md transition">
            @include('admin.dashboard-components.whole1')
        </div>

    </div>

@endsection
