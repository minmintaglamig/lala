<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client - @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">

    @include('layouts.navigation')

    <div>
        @include('components.sidebar-client')

        <main class="ml-64 p-6 min-h-screen">
            <h1 class="text-2xl font-bold mb-4 text-[#EA2F14]">@yield('title')</h1>
            @yield('content')
        </main>
    </div>

</body>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    const pricePerKmMap = {
        Bicycle: 10,
        Motorcycle: 15,
        Car: 20,
        Truck: 25,
        Van: 22,
        Bus: 30,
        Boat: 40,
        Airplane: 50,
        Train: 35,
        Helicopter: 60,
        Scooter: 14,
    };

    let map = L.map('map').setView([14.5995, 120.9842], 13);
    let pickupMarker = null;
    let dropoffMarker = null;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    function reverseGeocode(lat, lon, callback) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
            .then(res => res.json())
            .then(data => {
                if (data && data.display_name) callback(data.display_name);
                else callback("Unknown location");
            });
    }

    function calcDistance(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) ** 2 +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    function updateInfo() {
        if (!pickupMarker || !dropoffMarker) return;

        const p = pickupMarker.getLatLng();
        const d = dropoffMarker.getLatLng();

        reverseGeocode(p.lat, p.lng, (pickupAddress) => {
            document.getElementById("pickup_display").innerText = pickupAddress;
            document.getElementById("pickup_address").value = pickupAddress;
        });

        reverseGeocode(d.lat, d.lng, (dropoffAddress) => {
            document.getElementById("dropoff_display").innerText = dropoffAddress;
            document.getElementById("dropoff_address").value = dropoffAddress;
        });

        const dist = calcDistance(p.lat, p.lng, d.lat, d.lng).toFixed(2);
        document.getElementById("distance_display").innerText = dist;
        document.getElementById("distance_km").value = dist;

        const vehicleType = document.getElementById("vehicle_type").value;

        if (vehicleType && vehicleType in pricePerKmMap) {
            const pricePerKm = pricePerKmMap[vehicleType];
            const price = (dist * pricePerKm).toFixed(2);
            document.getElementById("price_display").innerText = price + " PHP";
            document.getElementById("price_php").value = price;
        } else {
            document.getElementById("price_display").innerText = "-";
            document.getElementById("price_php").value = "";
        }
    }

    function geocode(query, callback) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data && data.length > 0) {
                    callback({
                        lat: parseFloat(data[0].lat),
                        lon: parseFloat(data[0].lon),
                        display_name: data[0].display_name
                    });
                } else {
                    alert("Location not found: " + query);
                }
            });
    }

    function setPickupMarker(lat, lon) {
        if (pickupMarker) {
            pickupMarker.setLatLng([lat, lon]);
        } else {
            pickupMarker = L.marker([lat, lon], {
                draggable: true
            }).addTo(map).bindPopup("Pickup").openPopup();
            pickupMarker.on('dragend', updateInfo);
        }
        map.setView([lat, lon], 14);
        updateInfo();
    }

    function setDropoffMarker(lat, lon) {
        if (dropoffMarker) {
            dropoffMarker.setLatLng([lat, lon]);
        } else {
            dropoffMarker = L.marker([lat, lon], {
                draggable: true
            }).addTo(map).bindPopup("Dropoff").openPopup();
            dropoffMarker.on('dragend', updateInfo);
        }
        map.setView([lat, lon], 14);
        updateInfo();
    }
    document.getElementById("pickup_input").addEventListener("change", () => {
        const query = document.getElementById("pickup_input").value.trim();
        if (query.length === 0) return;
        geocode(query, (result) => {
            setPickupMarker(result.lat, result.lon);
        });
    });

    document.getElementById("dropoff_input").addEventListener("change", () => {
        const query = document.getElementById("dropoff_input").value.trim();
        if (query.length === 0) return;
        geocode(query, (result) => {
            setDropoffMarker(result.lat, result.lon);
        });
    });

    document.getElementById("vehicle_type").addEventListener("change", () => {
        updateInfo();
    });
</script>



</html>
