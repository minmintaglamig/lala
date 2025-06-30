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

    // Create the initial marker
    let marker = L.marker([{{ $latestLocation->latitude }}, {{ $latestLocation->longitude }}])
        .addTo(map)
        .bindPopup("Current Parcel Location")
        .openPopup();

    // Poll for latest location every 10 seconds
    function updateMarker() {
        fetch("{{ route('api.job.latest-location', ['jobId' => $job->id]) }}")
            .then(res => res.json())
            .then(loc => {
                if (loc.latitude && loc.longitude) {
                    marker.setLatLng([loc.latitude, loc.longitude])
                          .bindPopup("Updated: " + new Date(loc.timestamp).toLocaleString());
                }
            })
            .catch(err => {
                console.error('Error fetching latest location:', err);
            });
    }

    setInterval(updateMarker, 10000); // 10 seconds
</script>
@endif
@endsection
