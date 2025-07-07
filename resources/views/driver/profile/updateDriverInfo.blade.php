@extends('layouts.driver')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Driver Info') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl p-6 mx-auto bg-white shadow rounded-2xl">
        <h2 class="mb-6 text-2xl font-bold">Driver Personal Information</h2>

        {{-- Step Navigation --}}
        <div class="flex justify-center mb-6 space-x-4">
            <span
                class="px-4 py-2 rounded-full font-medium {{ Request::routeIs('driver.profile.updateDriverInfo') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                Personal Info
            </span>
            <span
                class="px-4 py-2 rounded-full font-medium {{ Request::routeIs('driver.profile.updateDriverMoreInfo') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                Additional Info
            </span>
        </div>

        {{-- Form --}}
        <form action="{{ route('driver.profile.updateDriverInfo') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach([
                'name' => 'Name',
                'phone_number' => 'Phone Number',
                'email' => 'Email',
                'address' => 'Address',
                'emergency_contact' => 'Emergency Contact'
                ] as $field => $label)
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">{{ $label }}</label>
                    <input type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                        value="{{ old($field, $driver->$field ?? '') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500"
                        {{ in_array($field, ['name', 'phone_number' ]) ? 'required' : '' }}>
                    @error($field)
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="dob"
                        value="{{ old('date_of_birth', $driver->date_of_birth ?? '') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Age</label>
                    <input type="text" id="age" name="age" readonly value="{{ old('age') }}"
                        class="w-full px-3 py-2 text-gray-700 bg-gray-100 border rounded-lg">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Gender</label>
                    <select name="gender"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        <option value="">Select</option>
                        <option value="Male" {{ old('gender', $driver->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="Female" {{ old('gender', $driver->gender ?? '') == 'Female' ? 'selected' : ''
                            }}>Female</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Marital Status</label>
                    <select name="marital_status"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        <option value="">Select</option>
                        @foreach(['Single', 'Married', 'Widowed', 'Divorced'] as $status)
                        <option value="{{ $status }}" {{ old('marital_status', $driver->marital_status ?? '') == $status
                            ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="flex justify-between">
                <a href="{{ url()->previous() }}"
                    class="px-6 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded-lg hover:bg-gray-300">
                    ← Back
                </a>

                <button type="submit" class="px-6 py-2 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                    Next: More Info
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');

            function calculateAge(dobValue) {
                if (!dobValue) return ageInput.value = '';
                const birthDate = new Date(dobValue);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                if (
                    today.getMonth() < birthDate.getMonth() ||
                    (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())
                ) {
                    age--;
                }
                ageInput.value = age;
            }

            if (dobInput.value) calculateAge(dobInput.value);
            dobInput.addEventListener('change', e => calculateAge(e.target.value));
        });
    </script>

</x-app-layout>