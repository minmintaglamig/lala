@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('content')
<div class="container mt-4">
    <h2>Driver Location Tracker</h2>
    <div id="map" style="height: 500px; width: 100%;"></div>
</div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const driverId = {{ $driverId ?? 1 }};

        const map = L.map('map').setView([14.5995, 120.9842], 12); // Default: Manila

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        function fetchLocation() {
            fetch(`/driver/${driverId}/location`)
                .then(res => res.json())
                .then(data => {
                    const lat = data.latitude;
                    const lng = data.longitude;

                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng]).addTo(map);
                    }

                    map.setView([lat, lng], 14);
                })
                .catch(err => {
                    console.error('Location fetch error:', err);
                });
        }

        fetchLocation();
        setInterval(fetchLocation, 10000);
    </script>
@endsection