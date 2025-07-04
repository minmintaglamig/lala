@extends('layouts.admin')

@section('title', 'Driver Profile')

@section('content')
    <div class="container py-4">


        {{-- Filters --}}
        <form method="GET" action="{{ route('admin.driver.index') }}" class="mb-4 row g-3">
            <div class="col-md-4">
                <input type="text" name="user_id" class="form-control" placeholder="Filter by Driver ID"
                    value="{{ request('user_id') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Filter by Name"
                    value="{{ request('name') }}">
            </div>
            <div class="gap-2 col-md-4 d-flex">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.driver.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table align-middle table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>License No</th>
                        <th>License Image</th>
                        <th>Medical Cert</th>
                        <th>Drug Test</th>
                        <th>Driver ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $driver)
                        <tr>
                            <td>{{ $driver->name ?? 'N/A' }}</td>
                            <td>{{ $driver->phone_number ?? 'N/A' }}</td>
                            <td>{{ $driver->license_number ?? 'N/A' }}</td>
                            <td>
                                @if ($driver->license_image)
                                    <img src="{{ asset('storage/' . $driver->license_image) }}" width="70"
                                        class="rounded">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($driver->medical_cert_file)
                                    <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank"
                                        class="btn btn-sm btn-outline-info">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($driver->drug_test_file)
                                    <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank"
                                        class="btn btn-sm btn-outline-info">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $driver->driver_id ?? 'N/A' }}</td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    <button onclick="openModal('viewModal{{ $driver->id }}')"
                                        class="px-3 py-1 text-sm text-white transition bg-green-500 rounded hover:bg-green-600">
                                        More Info
                                    </button>

                                    <a href="{{ route('admin.driver.edit', $driver->id) }}"
                                        class="px-3 py-1 text-sm text-white transition bg-yellow-500 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <button onclick="openModal('deleteModal{{ $driver->id }}')"
                                        class="px-3 py-1 text-sm text-white transition bg-red-600 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>
                            </td>


                        </tr>

                        {{-- View Modal --}}
                        @include('admin.driver.partials.view-modal', ['driver' => $driver])

                        {{-- Delete Modal --}}
                        @include('admin.driver.partials.delete-modal', ['driver' => $driver])

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No driver records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $drivers->links() }}
        </div>
    </div>
@endsection
