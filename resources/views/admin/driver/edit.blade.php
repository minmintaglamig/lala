@extends('layouts.admin')

@section('title', 'Edit Driver')

@section('content')
<div class="max-w-6xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h2 class="mb-6 text-2xl font-semibold"> Driver " {{ $driver->driver_id }}"</h2>


    <form action="{{ route('admin.driver.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach([
            ['name', 'Full Name'],
            ['phone_number', 'Contact Number'],
            ['email', 'Email', 'email'],
            ['address', 'Address'],
            ['date_of_birth', 'Date of Birth', 'date'],
            ['emergency_contact', 'Emergency Contact'],
            ] as $field)
            @php [$name, $label, $type] = array_pad($field, 3, 'text'); @endphp
            <div>
                <label class="block mb-1 text-sm font-medium">{{ $label }}</label>
                <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $driver->$name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error($name) border-red-500 @enderror">
                @error($name)
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            @endforeach

            {{-- Gender Dropdown --}}
            <div>
                <label class="block mb-1 text-sm font-medium">Gender</label>
                <select name="gender"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('gender') border-red-500 @enderror">
                    <option value="">Select</option>
                    @foreach(['Male', 'Female'] as $gender)
                    <option value="{{ $gender }}" {{ old('gender', $driver->gender) == $gender ? 'selected' : '' }}>
                        {{ $gender }}
                    </option>
                    @endforeach
                </select>
                @error('gender')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Marital Status Dropdown --}}
            <div>
                <label class="block mb-1 text-sm font-medium">Marital Status</label>
                <select name="marital_status"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('marital_status') border-red-500 @enderror">
                    <option value="">Select</option>
                    @foreach(['Single', 'Married', 'Divorced', 'Widowed'] as $status)
                    <option value="{{ $status }}" {{ old('marital_status', $driver->marital_status) == $status ?
                        'selected' : '' }}>
                        {{ $status }}
                    </option>
                    @endforeach
                </select>
                @error('marital_status')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        {{-- License & Work Info --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach([
            ['license_number', 'License Number'],
            ['license_expiry', 'License Expiry', 'date'],
            ['additional_permits', 'Additional Permits'],
            ['route_assigned', 'Route Assigned'],
            ['hire_date', 'Hire Date', 'date'],
            ] as $field)
            @php [$name, $label, $type] = array_pad($field, 3, 'text'); @endphp
            <div>
                <label class="block mb-1 text-sm font-medium">{{ $label }}</label>
                <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $driver->$name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error($name) border-red-500 @enderror">
                @error($name)
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            @endforeach

            {{-- License Type Dropdown --}}
            <div>
                <label class="block mb-1 text-sm font-medium">License Type</label>
                <select name="license_type" onchange="updateVehicleOptions()"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('license_type') border-red-500 @enderror">
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
                    'Prof B2 (Articulated)',
                    ] as $type)
                    <option value="{{ $type }}" {{ old('license_type', $driver->license_type) == $type ? 'selected' : ''
                        }}>
                        {{ $type }}
                    </option>
                    @endforeach
                </select>
                @error('license_type')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Vehicle Assigned (auto-filled) --}}
            <div>
                <label class="block mb-1 text-sm font-medium">Vehicle Assigned</label>
                <input type="text" name="vehicle_assigned" id="vehicle_assigned" readonly
                    value="{{ old('vehicle_assigned', $driver->vehicle_assigned) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('vehicle_assigned') border-red-500 @enderror">
                @error('vehicle_assigned')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Driver Status Dropdown --}}
            <div>
                <label class="block mb-1 text-sm font-medium">Driver Status</label>
                <select name="driver_status"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('driver_status') border-red-500 @enderror">
                    <option value="">Select</option>
                    @foreach(['full-time', 'part-time', 'contract'] as $status)
                    <option value="{{ $status }}" {{ old('driver_status', $driver->driver_status) == $status ?
                        'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                    @endforeach
                </select>
                @error('driver_status')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        {{-- File Uploads --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach([
            ['license_image', 'License Image', $driver->license_image],
            ['medical_cert_file', 'Medical Certificate', $driver->medical_cert_file],
            ['drug_test_file', 'Drug Test Result', $driver->drug_test_file],
            ] as [$field, $label, $existing])
            <div>
                <label class="block mb-1 text-sm font-medium">{{ $label }}</label>
                <input type="file" name="{{ $field }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error($field) border-red-500 @enderror">
                @error($field)
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                @if ($existing)
                @if(Str::endsWith($existing, ['.jpg', '.jpeg', '.png']))
                <img src="{{ asset('storage/' . $existing) }}" class="w-40 mt-2 rounded-md">
                @else
                <a href="{{ asset('storage/' . $existing) }}" class="block mt-2 text-blue-600 underline"
                    target="_blank">View Current File</a>
                @endif
                @endif
            </div>
            @endforeach
        </div>

        {{-- Submit --}}
        <div class="flex gap-4 mt-6">
            <button type="submit"
                class="px-6 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">Update Driver</button>
            <a href="{{ route('admin.driver.index') }}"
                class="px-6 py-2 text-gray-700 transition bg-gray-300 rounded-md hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function updateVehicleOptions() {
        const licenseType = document.querySelector('select[name="license_type"]')?.value;
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

    // Auto-call on load
    document.addEventListener('DOMContentLoaded', function () {
        updateVehicleOptions();
        document.querySelector('select[name="license_type"]').addEventListener('change', updateVehicleOptions);
    });
</script>
@endpush

@endsection