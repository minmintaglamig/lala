@extends('layouts.app')

@section('content')
<h2>Tracking Job #{{ $job->id }}</h2>

@if ($latestLocation)
    <div id="map" style="height: 400px;"></div>
@else
    <p>No location data available for this job yet.</p>
@endif
@endsection

@section('scripts')
@if ($latestLocation)
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-pMpr+v6sy1H0rGk3FuhMcHvHUSCmfQ4PqxF2kV9qqCM=" crossorigin=""></script>

<script>
    const map = L.map('map').setView([{{ $latestLocation->latitude }}, {{ $latestLocation->longitude }}], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([{{ $latestLocation->latitude }}, {{ $latestLocation->longitude }}])
        .addTo(map)
        .bindPopup("Current Parcel Location")
        .openPopup();
</script>
@endif
@endsection
