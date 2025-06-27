@extends('layouts.admin')

@section('title', 'DriverProfile')

@section('content')
<div class="container p-4 mt-5 bg-white rounded shadow">
    <h2 class="mb-4">Driver Additional Information</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('driver.store.drivermoreinfo', $driver->driver_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <!-- Step 1: Personal Info Display -->
        <div class="mb-4 card">
            <div class="text-white card-header bg-primary">Step 1: Personal Information</div>
            <div class="card-body row">
                <div class="mb-2 col-md-6"><strong>Full Name:</strong> {{ $driver->name }}, {{
                    $driver->first_name }} {{ $driver->middle_name }} {{ $driver->suffix }}</div>
                <div class="mb-2 col-md-6"><strong>Contact:</strong> {{ $driver->phone_number }}</div>
                <div class="mb-2 col-md-6"><strong>Email:</strong> {{ $driver->email ?? 'N/A' }}</div>
                <div class="mb-2 col-md-6"><strong>Address:</strong> {{ $driver->address ?? 'N/A' }}</div>
                <div class="mb-2 col-md-6"><strong>Date of Birth:</strong> {{
                    optional($driver->date_of_birth)->format('F d, Y') ?? 'N/A' }}</div>
            </div>
        </div>

        <!-- License Section -->
        <h5>License & Legal</h5>
        <div class="row">
            <!-- License Number -->
            <div class="mb-3 col-md-6">
                <label>License Number</label>
                <input type="text" name="license_number"
                    class="form-control @error('license_number') is-invalid @enderror"
                    value="{{ old('license_number', $driver->license_number) }}">
                @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <!-- License Expiry -->
            <div class="mb-3 col-md-6">
                <label>License Expiry</label>
                <input type="date" name="license_expiry"
                    class="form-control @error('license_expiry') is-invalid @enderror"
                    value="{{ old('license_expiry', $driver->license_expiry) }}">
                @error('license_expiry')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <!-- License Type -->
            <div class="mb-3 col-md-6">
                <label>License Type</label>
                <select name="license_type" class="form-control @error('license_type') is-invalid @enderror"
                    onchange="updateVehicleOptions()">
                    <option value="">-- Select License Type --</option>
                    @foreach([
                    'Student Permit',
                    'Non-Prof A (Motorcycle)',
                    'Non-Prof A1 (Tricycles)',
                    'Non-Prof B (Light Vehicles)',
                    'Prof A (Motorcycle)',
                    'Prof A1 (Tricycles)',
                    'Prof B (Light Vehicles)',
                    'Prof B1 (Heavy Vehicles)',
                    'Prof B2 (Articulated)'
                    ] as $type)
                    <option value="{{ $type }}" {{ old('license_type', $driver->license_type) == $type ? 'selected'
                        : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('license_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <!-- Additional Permits -->
            <div class="mb-3 col-md-6">
                <label>Additional Permits</label>
                <input type="text" name="additional_permits"
                    class="form-control @error('additional_permits') is-invalid @enderror"
                    value="{{ old('additional_permits', $driver->additional_permits) }}">
                @error('additional_permits')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <!-- License Image -->
            <div class="mb-3 col-md-12">
                <label>License Image</label>
                <input type="file" name="license_image"
                    class="form-control @error('license_image') is-invalid @enderror">
                @error('license_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @if($driver->license_image)
                <img src="{{ asset('storage/' . $driver->license_image) }}" class="mt-2 img-thumbnail" width="200">
                @endif
            </div>
        </div>

        <!-- Work Info -->
        <h5 class="mt-4">Work Info</h5>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Driver ID</label>
                <input type="text" name="driver_id" class="form-control" value="{{ $driver->driver_id }}" readonly>
            </div>

            <div class="mb-3 col-md-6">
                <label>Driver Status</label>
                <select name="driver_status" class="form-control">
                    @foreach(['full-time', 'part-time', 'contract'] as $status)
                    <option value="{{ $status }}" {{ old('driver_status', $driver->driver_status) === $status ?
                        'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label>Hire Date</label>
                <input type="date" name="hire_date" class="form-control"
                    value="{{ old('hire_date', $driver->hire_date) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label>Vehicle Assigned</label>
                <input type="text" name="vehicle_assigned" class="form-control"
                    value="{{ old('vehicle_assigned', $driver->vehicle_assigned) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label>Route Assigned</label>
                <input type="text" name="route_assigned" class="form-control"
                    value="{{ old('route_assigned', $driver->route_assigned) }}">
            </div>
        </div>

        <!-- Health Info -->
        <h5 class="mt-4">Health & Safety</h5>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Medical Certificate</label>
                <input type="file" name="medical_cert_file"
                    class="form-control @error('medical_cert_file') is-invalid @enderror">
                @error('medical_cert_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @if($driver->medical_cert_file)
                <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank">View Uploaded
                    File</a>
                @endif
            </div>

            <div class="mb-3 col-md-6">
                <label>Drug Test Result</label>
                <input type="file" name="drug_test_file"
                    class="form-control @error('drug_test_file') is-invalid @enderror">
                @error('drug_test_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @if($driver->drug_test_file)
                <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank">View Uploaded File</a>
                @endif
            </div>
        </div>

        <div class="gap-2 mt-4 d-flex">
            <button type="submit" class="btn btn-success">Save Driver Info</button>
            <a href="{{ url('/vehicles/assign/' . $driver->driver_id) }}" class="btn btn-outline-primary">Vehicle</a>
        </div>
    </form>
</div>

@push('scripts')
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
@endpush
@endsection