<div class="modal fade" id="viewModal{{ $driver->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $driver->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="text-white modal-header bg-primary">
                <h5 class="modal-title">Driver Details - {{ $driver->driver_id }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><strong>Name:</strong> {{ $driver->name }}</div>
                    <div class="col-md-6"><strong>Contact:</strong> {{ $driver->phone_number }}</div>
                    <div class="col-md-6"><strong>Email:</strong> {{ $driver->email }}</div>
                    <div class="col-md-6"><strong>Address:</strong> {{ $driver->address }}</div>
                    <div class="col-md-6"><strong>DOB:</strong> {{ $driver->date_of_birth }}</div>
                    <div class="col-md-6"><strong>Gender:</strong> {{ $driver->gender }}</div>
                    <div class="col-md-6"><strong>Emergency Contact:</strong> {{ $driver->emergency_contact }}</div>
                    <div class="col-md-6"><strong>License Number:</strong> {{ $driver->license_number }}</div>
                    <div class="col-md-6"><strong>License Expiry:</strong> {{ $driver->license_expiry }}</div>
                    <div class="col-md-6"><strong>License Type:</strong> {{ $driver->license_type }}</div>
                    <div class="col-md-6"><strong>Additional Permits:</strong> {{ $driver->additional_permits }}</div>
                    <div class="col-md-6"><strong>Vehicle Assigned:</strong> {{ $driver->vehicle_assigned }}</div>
                    <div class="col-md-6"><strong>Route:</strong> {{ $driver->route_assigned }}</div>
                    <div class="col-md-6"><strong>Status:</strong> {{ $driver->driver_status }}</div>
                    <div class="col-md-6"><strong>Hire Date:</strong> {{ $driver->hire_date }}</div>
                    <div class="col-md-6">
                        <strong>License Image:</strong><br>
                        @if($driver->license_image)
                        <img src="{{ asset('storage/' . $driver->license_image) }}" width="150" class="rounded">
                        @else N/A @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Medical Cert:</strong><br>
                        @if($driver->medical_cert_file)
                        <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank">View</a>
                        @else N/A @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Drug Test:</strong><br>
                        @if($driver->drug_test_file)
                        <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank">View</a>
                        @else N/A @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>