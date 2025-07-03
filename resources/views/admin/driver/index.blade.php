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
                <thead class="text-black bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Contact</th>
                        <th class="px-4 py-2 text-left">License No</th>
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
                        <td class="px-4 py-2">
                            @if($driver->license_image)
                            <img src="{{ asset('storage/' . $driver->license_image) }}" class="w-16 rounded">
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
                        <td class="px-4 py-2">{{ $driver->driver_id ?? 'N/A' }}</td>
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
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">No driver records found.</td>
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
    </main>
</div>
@endsection