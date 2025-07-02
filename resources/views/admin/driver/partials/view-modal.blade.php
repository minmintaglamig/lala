<!-- Tailwind Modal -->
<div id="viewModal{{ $driver->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50"
    aria-labelledby="viewModalLabel{{ $driver->id }}" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="w-full max-w-6xl bg-white rounded-lg shadow-xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 text-white bg-blue-600 rounded-t-lg">
                <h2 class="text-lg font-semibold">Driver Details - {{ $driver->driver_id }}</h2>
                <button onclick="closeModal('viewModal{{ $driver->id }}')" class="text-xl text-white">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
                <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                    <div><strong>Name:</strong> {{ $driver->name }}</div>
                    <div><strong>Contact:</strong> {{ $driver->phone_number }}</div>
                    <div><strong>Email:</strong> {{ $driver->email }}</div>
                    <div><strong>Address:</strong> {{ $driver->address }}</div>
                    <div><strong>DOB:</strong> {{ $driver->date_of_birth }}</div>
                    <div><strong>Gender:</strong> {{ $driver->gender }}</div>
                    <div><strong>Emergency Contact:</strong> {{ $driver->emergency_contact }}</div>
                    <div><strong>License Number:</strong> {{ $driver->license_number }}</div>
                    <div><strong>License Expiry:</strong> {{ $driver->license_expiry }}</div>
                    <div><strong>License Type:</strong> {{ $driver->license_type }}</div>
                    <div><strong>Additional Permits:</strong> {{ $driver->additional_permits }}</div>
                    <div><strong>Vehicle Assigned:</strong> {{ $driver->vehicle_assigned }}</div>
                    <div><strong>Route:</strong> {{ $driver->route_assigned }}</div>
                    <div><strong>Status:</strong> {{ $driver->driver_status }}</div>
                    <div><strong>Hire Date:</strong> {{ $driver->hire_date }}</div>

                    <div>
                        <strong>License Image:</strong><br>
                        @if($driver->license_image)
                        <img src="{{ asset('storage/' . $driver->license_image) }}" alt="License Image"
                            class="mt-2 rounded w-36">
                        @else
                        N/A
                        @endif
                    </div>

                    <div>
                        <strong>Medical Cert:</strong><br>
                        @if($driver->medical_cert_file)
                        <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank"
                            class="text-blue-600 underline">View</a>
                        @else
                        N/A
                        @endif
                    </div>

                    <div>
                        <strong>Drug Test:</strong><br>
                        @if($driver->drug_test_file)
                        <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank"
                            class="text-blue-600 underline">View</a>
                        @else
                        N/A
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end px-6 py-4 border-t rounded-b-lg">
                <button onclick="closeModal('viewModal{{ $driver->id }}')"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>