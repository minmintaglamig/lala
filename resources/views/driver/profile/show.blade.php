@extends('layouts.driver')

@section('title', 'My Profile')

@section('content')
<div class="container p-4 bg-white rounded shadow">
    <h2 class="mb-4">Driver Profile</h2>

    <div><strong>Driver ID:</strong> {{ $driver->user_id }}</div>
    <div><strong>Name:</strong> {{ $driver->name }}</div>
    <div><strong>Phone:</strong> {{ $driver->phone_number }}</div>
    <div><strong>Email:</strong> {{ $driver->email }}</div>
    <div><strong>Address:</strong> {{ $driver->address }}</div>
    <div><strong>Date of Birth:</strong> {{ $driver->date_of_birth }}</div>
    <div><strong>Age:</strong> {{ $driver->age }}</div>
    <div><strong>Gender:</strong> {{ $driver->gender }}</div>
    <div><strong>Marital Status:</strong> {{ $driver->marital_status }}</div>
    <div><strong>Emergency Contact:</strong> {{ $driver->emergency_contact }}</div>
    <div><strong>License Number:</strong> {{ $driver->license_number }}</div>
    <div><strong>License Type:</strong> {{ $driver->license_type }}</div>
    <div><strong>License Expiry:</strong> {{ $driver->license_expiry }}</div>
    <div><strong>Vehicle Assigned:</strong> {{ $driver->vehicle_assigned }}</div>
    <div><strong>Route Assigned:</strong> {{ $driver->route_assigned }}</div>
    <div><strong>Driver Status:</strong> {{ $driver->driver_status }}</div>
    <div><strong>Hire Date:</strong> {{ $driver->hire_date }}</div>

    <div class="gap-2 mt-4 d-flex">
        <a href="{{ route('driver.profile.updateDriverInfoForm') }}" class="btn btn-warning">Update Personal Info</a>
    </div>

</div>
@endsection