@extends('layouts.driver')

@section('title', 'DriverProfile')

@section('content')

    <div class="container p-4 bg-white rounded shadow">
        <h2 class="mb-4">Driver Personal Information</h2>

        <form action="{{ route('driver.store.driverinfo') }}" method="POST">
            @csrf
            <div class="row">

                {{-- Text Fields --}}
                @foreach([
                'last_name' => 'Last Name',
                'first_name' => 'First Name',
                'middle_name' => 'Middle Name',
                'suffix' => 'Suffix',
                'contact_number' => 'Contact Number',
                'email' => 'Email',
                'address' => 'Address',
                'emergency_contact' => 'Emergency Contact'
                ] as $field => $label)
                <div class="mb-3 col-md-6">
                    <label>{{ $label }}</label>
                    <input type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                        class="form-control @error($field) is-invalid @enderror" value="{{ old($field) }}" {{
                        in_array($field, ['last_name','first_name','middle_name','contact_number']) ? 'required' : ''
                        }}>
                    @error($field)
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach

                {{-- Date of Birth --}}
                <div class="mb-3 col-md-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" id="dob" class="form-control"
                        value="{{ old('date_of_birth') }}">
                </div>

                {{-- Age --}}
                <div class="mb-3 col-md-3">
                    <label>Age</label>
                    <input type="text" name="age" id="age" class="form-control" readonly>
                </div>

                {{-- Gender --}}
                <div class="mb-3 col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select</option>
                        <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                {{-- Marital Status --}}
                <div class="mb-3 col-md-3">
                    <label>Marital Status</label>
                    <select name="marital_status" class="form-control">
                        <option value="">Select</option>
                        <option value="Single" {{ old('marital_status')=='Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('marital_status')=='Married' ? 'selected' : '' }}>Married
                        </option>
                        <option value="Widowed" {{ old('marital_status')=='Widowed' ? 'selected' : '' }}>Widowed
                        </option>
                        <option value="Divorced" {{ old('marital_status')=='Divorced' ? 'selected' : '' }}>Divorced
                        </option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Next: More Info</button>
        </form>
    </div>

    {{-- Auto-calculate age --}}
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

            // Load old value if available
            if (dobInput.value) {
                calculateAge(dobInput.value);
            }

            // Recalculate on change
            dobInput.addEventListener('change', function () {
                calculateAge(this.value);
            });
        });
    </script>

@endsection