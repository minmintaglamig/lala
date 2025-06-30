@extends('layouts.admin')

@section('title', 'Edit Driver')

@section('content')
<div class="container p-4 bg-white rounded shadow">
    <h2 class="mb-4">Edit Driver - {{ $driver->driver_id }}</h2>

    <form action="{{ route('admin.driver.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Basic Information --}}
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $driver->name) }}" required>
            </div>

            <div class="col-md-6">
                <label for="phone_number" class="form-label">Contact Number</label>
                <input type="text" name="phone_number" class="form-control"
                    value="{{ old('phone_number', $driver->phone_number) }}" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $driver->email) }}">
            </div>

            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $driver->address) }}">
            </div>

            <div class="col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control"
                    value="{{ old('date_of_birth', $driver->date_of_birth) }}">
            </div>

            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" name="gender" class="form-control" value="{{ old('gender', $driver->gender) }}">
            </div>

            <div class="col-md-6">
                <label for="marital_status" class="form-label">Marital Status</label>
                <input type="text" name="marital_status" class="form-control"
                    value="{{ old('marital_status', $driver->marital_status) }}">
            </div>

            <div class="col-md-6">
                <label for="emergency_contact" class="form-label">Emergency Contact</label>
                <input type="text" name="emergency_contact" class="form-control"
                    value="{{ old('emergency_contact', $driver->emergency_contact) }}">
            </div>
        </div>

        <hr class="my-4">

        {{-- License and Vehicle Info --}}
        <div class="row g-3">
            <div class="col-md-6">
                <label for="license_number" class="form-label">License Number</label>
                <input type="text" name="license_number" class="form-control"
                    value="{{ old('license_number', $driver->license_number) }}">
            </div>

            <div class="col-md-6">
                <label for="license_expiry" class="form-label">License Expiry</label>
                <input type="date" name="license_expiry" class="form-control"
                    value="{{ old('license_expiry', $driver->license_expiry) }}">
            </div>

            <div class="col-md-6">
                <label for="license_type" class="form-label">License Type</label>
                <input type="text" name="license_type" class="form-control"
                    value="{{ old('license_type', $driver->license_type) }}">
            </div>

            <div class="col-md-6">
                <label for="vehicle_assigned" class="form-label">Vehicle Assigned</label>
                <input type="text" name="vehicle_assigned" class="form-control"
                    value="{{ old('vehicle_assigned', $driver->vehicle_assigned) }}">
            </div>

            <div class="col-md-6">
                <label for="route_assigned" class="form-label">Route Assigned</label>
                <input type="text" name="route_assigned" class="form-control"
                    value="{{ old('route_assigned', $driver->route_assigned) }}">
            </div>

            <div class="col-md-6">
                <label for="additional_permits" class="form-label">Additional Permits</label>
                <input type="text" name="additional_permits" class="form-control"
                    value="{{ old('additional_permits', $driver->additional_permits) }}">
            </div>

            <div class="col-md-6">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" name="hire_date" class="form-control"
                    value="{{ old('hire_date', $driver->hire_date) }}">
            </div>

            <div class="col-md-6">
                <label for="driver_status" class="form-label">Status</label>
                <input type="text" name="driver_status" class="form-control"
                    value="{{ old('driver_status', $driver->driver_status) }}">
            </div>
        </div>

        <hr class="my-4">

        {{-- File Uploads --}}
        <div class="row g-3">
            <div class="col-md-4">
                <label for="license_image" class="form-label">License Image</label>
                <input type="file" name="license_image" class="form-control">
                @if ($driver->license_image)
                <img src="{{ asset('storage/' . $driver->license_image) }}" class="mt-2" width="150">
                @endif
            </div>

            <div class="col-md-4">
                <label for="medical_cert_file" class="form-label">Medical Certificate</label>
                <input type="file" name="medical_cert_file" class="form-control">
                @if ($driver->medical_cert_file)
                <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" class="mt-2 d-block" target="_blank">View
                    Current</a>
                @endif
            </div>

            <div class="col-md-4">
                <label for="drug_test_file" class="form-label">Drug Test</label>
                <input type="file" name="drug_test_file" class="form-control">
                @if ($driver->drug_test_file)
                <a href="{{ asset('storage/' . $driver->drug_test_file) }}" class="mt-2 d-block" target="_blank">View
                    Current</a>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Driver</button>
            <a href="{{ route('admin.driver.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection