@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Send My Current Location</h2>
    <form action="{{ route('driver.location.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" name="latitude" id="latitude" required>
        </div>
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" class="form-control" name="longitude" id="longitude" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Location</button>
    </form>
</div>
@endsection
