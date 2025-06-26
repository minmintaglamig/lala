@extends('layouts.admin')

@section('title', 'Edit Vehicle')

@section('content')
    <h2>Edit Vehicle</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Plate Number:</label>
            <input type="text" name="plate_number" value="{{ $vehicle->plate_number }}" required>
        </div>

        <div>
            <label>Type:</label>
            <input type="text" name="type" value="{{ $vehicle->type }}" required>
        </div>

        <div>
            <label>Model:</label>
            <input type="text" name="model" value="{{ $vehicle->model }}" required>
        </div>

        <div>
            <label>Capacity:</label>
            <input type="number" name="capacity" value="{{ $vehicle->capacity }}" required>
        </div>

        <div>
            <label>Status:</label>
            <input type="text" name="status" value="{{ $vehicle->status }}" required>
        </div>

        <div style="margin-top: 10px;">
            <button type="submit" style="background-color: #4f46e5; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                Update Vehicle
            </button>
        </div>
    </form>
@endsection
