@extends('layouts.admin')

@section('title', 'Vehicles')

@section('content')
    {{-- <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

        <a href="{{ route('admin.vehicle.create') }}" class="btn btn-primary"
            style="padding: 10px 20px; background-color: #4f46e5; color: white; text-decoration: none; border-radius: 5px;">
            Register Vehicle
        </a>
    </div> --}}

    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th>ID</th>
                <th>Driver ID</th>
                <th>Plate Number</th>
                <th>Type</th>
                <th>Model</th>
                <th>Capacity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->driver_id }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->capacity }}</td>
                    <td>{{ $vehicle->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th>DRIVER ID</th>
                <th>NAME</th>
                <th>ROLE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($driverprofile as $driverprofiles)
                <tr>
                    <td>{{ $driverprofiles->id }}</td>
                    <td>{{ $driverprofiles->name }}</td>
                    <td>{{ $driverprofiles->role }}</td>
                    <td>
                        <a href="{{ route('admin.driver.show', $driverprofiles->id) }}">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No driver found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
