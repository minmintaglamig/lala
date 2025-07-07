@extends('layouts.admin')

@section('title', 'Driver Profile')

@section('content')
<div class="flex min-h-screen">
    <div class="container mx-auto">

        {{-- Filters --}}
        <form method="GET" action="{{ route('admin.driver.index') }}"
            class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
            <input type="text" name="user_id" class="w-full px-3 py-2 border rounded" placeholder="Filter by Driver ID"
                value="{{ request('user_id') }}">
            <input type="text" name="name" class="w-full px-3 py-2 border rounded" placeholder="Filter by Name"
                value="{{ request('name') }}">
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Filter</button>
                <a href="{{ route('admin.driver.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Reset</a>
            </div>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto border rounded shadow bg-orange">
            <table class="w-full table-auto">
                <thead class="text-black bg-orange-800">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Contact</th>
                        <th class="px-4 py-2 text-left">License No</th>
                        <th class="px-4 py-2 text-left">Availability</th>
                        <th class="px-4 py-2 text-left">License Image</th>
                        <th class="px-4 py-2 text-left">Medical Cert</th>
                        <th class="px-4 py-2 text-left">Drug Test</th>
                        <th class="px-4 py-2 text-left">Driver ID</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @forelse($drivers as $driver)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $driver->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $driver->phone_number ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $driver->license_number ?? 'N/A' }}</td>

                        {{-- Editable Availability Dropdown --}}
                        <td class="px-4 py-2">
                            @php
                            $status = $driver->availability_status ?? 'Not Set';
                            $badgeColors = [
                            'Available' => 'bg-green-100 text-green-800 border-green-500',
                            'On Delivery' => 'bg-yellow-100 text-yellow-800 border-yellow-500',
                            'Off Duty' => 'bg-gray-100 text-gray-700 border-gray-400',
                            'Not Set' => 'bg-red-100 text-red-700 border-red-500',
                            ];
                            $badgeClass = $badgeColors[$status] ?? 'bg-gray-100 text-gray-700 border-gray-300';
                            @endphp

                            <form method="POST" action="{{ route('admin.driver.availability.set', $driver->id) }}">
                                @csrf
                                <select name="availability_status" onchange="this.form.submit()"
                                    class="px-2 py-1 text-sm border rounded {{ $badgeClass }}">
                                    <option value="Available" {{ $status==='Available' ? 'selected' : '' }}>Available
                                    </option>
                                    <option value="On Delivery" {{ $status==='On Delivery' ? 'selected' : '' }}>On
                                        Delivery</option>
                                    <option value="Off Duty" {{ $status==='Off Duty' ? 'selected' : '' }}>Off Duty
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td class="px-4 py-2">
                            @if($driver->license_image)
                            <a href="{{ asset('storage/' . $driver->license_image) }}" target="_blank"
                                class="text-blue-600 underline">View</a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if($driver->medical_cert_file)
                            <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank"
                                class="text-blue-600 underline">View</a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if($driver->drug_test_file)
                            <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank"
                                class="text-blue-600 underline">View</a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $driver->user_id ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                <button onclick="openModal('viewModal{{ $driver->id }}')"
                                    class="px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700">More
                                    Info</button>
                                <a href="{{ route('admin.driver.edit', $driver->id) }}"
                                    class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                                <button onclick="openModal('deleteModal{{ $driver->id }}')"
                                    class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                            </div>
                        </td>
                    </tr>

                    {{-- Include Modals --}}
                    @include('admin.driver.partials.view-modal', ['driver' => $driver])
                    @include('admin.driver.partials.delete-modal', ['driver' => $driver])
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">No driver records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $drivers->links() }}
        </div>
    </div>
</div>
@endsection