@extends('layouts.driver')

@section('title', 'Dashboard')

@extends('layouts.admin')

@section('title', 'Edit Driver Profile')

@section('content')
<div class="container p-4 bg-white rounded shadow">
    <h2 class="mb-4">Edit Driver Profile</h2>

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

    <form action="{{ route('driver.profile.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @foreach([
            'name' => 'Name',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'address' => 'Address',
            'emergency_contact' => 'Emergency Contact'
            ] as $field => $label)
            <div class="mb-3 col-md-6">
                <label>{{ $label }}</label>
                <input type="text" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror"
                    value="{{ old($field, $driver->$field) }}" {{ in_array($field, ['name','phone_number']) ? 'required'
                    : '' }}>
                @error($field)
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @endforeach

            <div class="mb-3 col-md-3">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" id="dob" class="form-control"
                    value="{{ old('date_of_birth', $driver->date_of_birth) }}">
            </div>

            <div class="mb-3 col-md-3">
                <label>Age</label>
                <input type="text" name="age" id="age" class="form-control" value="{{ old('age', $driver->age) }}"
                    readonly>
            </div>

            <div class="mb-3 col-md-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="Male" {{ old('gender', $driver->gender)=='Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $driver->gender)=='Female' ? 'selected' : '' }}>Female
                    </option>
                </select>
            </div>

            <div class="mb-3 col-md-3">
                <label>Marital Status</label>
                <select name="marital_status" class="form-control">
                    <option value="">Select</option>
                    <option value="Single" {{ old('marital_status', $driver->marital_status)=='Single' ? 'selected' : ''
                        }}>Single</option>
                    <option value="Married" {{ old('marital_status', $driver->marital_status)=='Married' ? 'selected' :
                        '' }}>Married</option>
                    <option value="Widowed" {{ old('marital_status', $driver->marital_status)=='Widowed' ? 'selected' :
                        '' }}>Widowed</option>
                    <option value="Divorced" {{ old('marital_status', $driver->marital_status)=='Divorced' ? 'selected'
                        : '' }}>Divorced</option>
                </select>
            </div>
        </div>

        <hr class="my-4">
        <h4>Driver Additional Information</h4>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label>License Number</label>
                <input type="text" name="license_number" class="form-control"
                    value="{{ old('license_number', $driver->license_number) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label>License Expiry</label>
                <input type="date" name="license_expiry" class="form-control"
                    value="{{ old('license_expiry', $driver->license_expiry) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label>License Type</label>
                <select name="license_type" class="form-control" onchange="updateVehicleOptions()">
                    <option value="">Select</option>
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
                    <option value="{{ $type }}" {{ old('license_type', $driver->license_type) == $type ? 'selected' : ''
                        }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label>Additional Permits</label>
                <input type="text" name="additional_permits" class="form-control"
                    value="{{ old('additional_permits', $driver->additional_permits) }}">
            </div>

            <div class="mb-3 col-md-12">
                <label>License Image</label>
                <input type="file" name="license_image" class="form-control">
                @if($driver->license_image)
                <img src="{{ asset('storage/' . $driver->license_image) }}" class="mt-2 img-thumbnail" width="200">
                @endif
            </div>

            <div class="mb-3 col-md-6">
                <label>Driver Status</label>
                <select name="driver_status" class="form-control">
                    @foreach(['full-time', 'part-time', 'contract'] as $status)
                    <option value="{{ $status }}" {{ old('driver_status', $driver->driver_status) == $status ?
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

            <div class="mb-3 col-md-6">
                <label>Medical Certificate</label>
                <input type="file" name="medical_cert_file" class="form-control">
                @if($driver->medical_cert_file)
                <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank">View</a>
                @endif
            </div>

            <div class="mb-3 col-md-6">
                <label>Drug Test Result</label>
                <input type="file" name="drug_test_file" class="form-control">
                @if($driver->drug_test_file)
                <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank">View</a>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">Save Driver Info</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dobInput = document.getElementById('dob');
        const ageInput = document.getElementById('age');

        function calculateAge(dobValue) {
            if (!dobValue) {
                ageInput.value = '';
                return;
            }

            const birthDate = new Date(dobValue);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const month = today.getMonth() - birthDate.getMonth();

            if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            ageInput.value = age;
        }

        if (dobInput.value) {
            calculateAge(dobInput.value);
        }

        dobInput.addEventListener('change', function () {
            calculateAge(this.value);
        });
    });

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
@endsection