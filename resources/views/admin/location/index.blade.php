@extends('layouts.admin')

@section('title', 'Driver Location Map')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Static Driver Location</h2>
        <div id="map"></div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([14.5995, 120.9842], 10); // Manila as center

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Static example markers
        const staticLocations = [
            { lat: 14.5995, lng: 120.9842, label: 'Driver 1 - Manila' },
            { lat: 14.6760, lng: 121.0437, label: 'Driver 2 - QC' },
            { lat: 14.5547, lng: 121.0244, label: 'Driver 3 - Makati' }
        ];

        staticLocations.forEach(loc => {
            L.marker([loc.lat, loc.lng])
                .addTo(map)
                .bindPopup(loc.label);
        });
    </script>
@endpush
