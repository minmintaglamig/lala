<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inProgressJobs = @json($alljobs).filter(job => job.delivery_status ===
            'in_progress');

        const inProgressMap = L.map('inProgressMap').setView([14.5995, 120.9842], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(inProgressMap);

        const inProgressMarkers = L.layerGroup().addTo(inProgressMap);

        inProgressJobs.forEach(job => {
            const id = job.id ?? 'N/A';

            const pickupLat = parseFloat(job.pickup_latitude);
            const pickupLng = parseFloat(job.pickup_longitude);
            const dropoffLat = parseFloat(job.dropoff_latitude);
            const dropoffLng = parseFloat(job.dropoff_longitude);

            if (!isNaN(pickupLat) && !isNaN(pickupLng)) {
                const pickupMarker = L.marker([pickupLat, pickupLng]).addTo(inProgressMarkers);
                pickupMarker.bindPopup(
                    `<b>Pickup</b><br>ID: ${id}<br>Lat: ${pickupLat}<br>Lng: ${pickupLng}`);

                const pickupLabel = L.divIcon({
                    className: 'pickup-label',
                    html: `<div style="transform: translateY(-20px); background: #fff; padding: 2px 6px; border-radius: 4px; font-size: 10px; color: #EA2F14; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">${id}</div>`,
                    iconSize: [0, 0],
                    iconAnchor: [0, 0],
                });

                L.marker([pickupLat, pickupLng], {
                    icon: pickupLabel
                }).addTo(inProgressMarkers);
            }

            if (!isNaN(dropoffLat) && !isNaN(dropoffLng)) {
                const dropoffMarker = L.marker([dropoffLat, dropoffLng]).addTo(inProgressMarkers);
                dropoffMarker.bindPopup(
                    `<b>Dropoff</b><br>ID: ${id}<br>Lat: ${dropoffLat}<br>Lng: ${dropoffLng}`);

                const dropoffLabel = L.divIcon({
                    className: 'dropoff-label',
                    html: `<div style="transform: translateY(-20px); background: #fff; padding: 2px 6px; border-radius: 4px; font-size: 10px; color: #1D4ED8; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">${id}</div>`,
                    iconSize: [0, 0],
                    iconAnchor: [0, 0],
                });

                L.marker([dropoffLat, dropoffLng], {
                    icon: dropoffLabel
                }).addTo(inProgressMarkers);
            }
        });

        if (inProgressMarkers.getLayers().length > 0) {
            inProgressMap.fitBounds(inProgressMarkers.getBounds().pad(0.2));
        }
    });
</script>
