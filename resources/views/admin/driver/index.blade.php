@extends('layouts.admin')

@section('title', 'Driver Profile')

@section('content')
<div class="container py-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <a href="{{ route('admin.driver.create') }}" class="btn btn-success">+ Add New Driver</a>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.driver.index') }}" class="mb-4 row g-3">
        <div class="col-md-4">
            <input type="text" name="driver_id" class="form-control" placeholder="Filter by Driver ID"
                value="{{ request('driver_id') }}">
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
                        @if($driver->license_image)
                        <img src="{{ asset('storage/' . $driver->license_image) }}" width="70" class="rounded">
                        @else N/A @endif
                    </td>
                    <td>
                        @if($driver->medical_cert_file)
                        <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank"
                            class="btn btn-sm btn-outline-info">View</a>
                        @else N/A @endif
                    </td>
                    <td>
                        @if($driver->drug_test_file)
                        <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank"
                            class="btn btn-sm btn-outline-info">View</a>
                        @else N/A @endif
                    </td>
                    <td>{{ $driver->driver_id ?? 'N/A' }}</td>
                    <td class="gap-1 d-flex">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal{{ $driver->id }}">View</button>
                        <a href="{{ route('admin.driver.edit', $driver->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $driver->id }}">Delete</button>
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