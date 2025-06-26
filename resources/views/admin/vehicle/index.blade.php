@extends('layouts.admin')

@section('title', 'Vehicles')

@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
    @endphp

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        @if ($user->role !== 'admin')
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary"
                style="padding: 10px 20px; background-color: #4f46e5; color: white; text-decoration: none; border-radius: 5px;">
                Register Vehicle
            </a>
        @endif
    </div>

    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th>ID</th>
                <th>Driver ID</th>
                <th>Plate Number</th>
                <th>Type</th>
                <th>Model</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Action</th>
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
                    <td>
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" 
                                style="color: white; background-color: #10b981; padding: 5px 10px; border-radius: 4px; text-decoration: none;">
                                Edit
                            </a>
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="color: white; background-color: #ef4444; padding: 5px 10px; border: none; border-radius: 4px;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
