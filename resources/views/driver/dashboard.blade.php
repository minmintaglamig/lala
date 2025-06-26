<x-app-layout>
    @section('content')
    <div class="p-6">Welcome to Driver Dashboard!</div>

    <div class="container p-4 bg-white rounded shadow">
        <h2 class="mb-4">All Driver Records</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('drivers.index') }}" class="mb-4 row g-3">
            <div class="col-md-4">
                <input type="text" name="driver_id" class="form-control" placeholder="Filter by Driver ID"
                    value="{{ request('driver_id') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Filter by Name"
                    value="{{ request('name') }}">
            </div>
            <div class="gap-2 col-md-4 d-flex">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- Driver Table -->
        <table class="table align-middle table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>License No</th>
                    <th>License Image</th>
                    <th>Medical Cert</th>
                    <th>Drug Test</th>
                    <th>Driver ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->last_name }}, {{ $driver->first_name }}</td>
                    <td>{{ $driver->contact_number }}</td>
                    <td>{{ $driver->license_number }}</td>
                    <td>
                        @if($driver->license_image)
                        <img src="{{ asset('storage/' . $driver->license_image) }}" width="100">
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        @if($driver->medical_cert_file)
                        <a href="{{ asset('storage/' . $driver->medical_cert_file) }}" target="_blank">View</a>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        @if($driver->drug_test_file)
                        <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank">View</a>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>{{ $driver->driver_id ?? 'N/A' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal{{ $driver->id }}">
                            View
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="viewModal{{ $driver->id }}" tabindex="-1"
                    aria-labelledby="viewModalLabel{{ $driver->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="text-white modal-header bg-primary">
                                <h5 class="modal-title">Driver Details - {{ $driver->driver_id }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6"><strong>Name:</strong> {{ $driver->last_name }}, {{
                                        $driver->first_name }} {{ $driver->middle_name }} {{ $driver->suffix }}</div>
                                    <div class="col-md-6"><strong>Contact:</strong> {{ $driver->contact_number }}</div>
                                    <div class="col-md-6"><strong>Email:</strong> {{ $driver->email }}</div>
                                    <div class="col-md-6"><strong>Address:</strong> {{ $driver->address }}</div>
                                    <div class="col-md-6"><strong>DOB:</strong> {{ $driver->date_of_birth }}</div>
                                    <div class="col-md-6"><strong>Gender:</strong> {{ $driver->gender }}</div>
                                    <div class="col-md-6"><strong>Emergency Contact:</strong> {{
                                        $driver->emergency_contact }}</div>
                                    <hr class="my-2">
                                    <div class="col-md-6"><strong>License Number:</strong> {{ $driver->license_number }}
                                    </div>
                                    <div class="col-md-6"><strong>License Expiry:</strong> {{ $driver->license_expiry }}
                                    </div>
                                    <div class="col-md-6"><strong>License Type:</strong> {{ $driver->license_type }}
                                    </div>
                                    <div class="col-md-6"><strong>Additional Permits:</strong> {{
                                        $driver->additional_permits }}</div>
                                    <div class="col-md-6"><strong>Vehicle Assigned:</strong> {{
                                        $driver->vehicle_assigned }}</div>
                                    <div class="col-md-6"><strong>Route:</strong> {{ $driver->route_assigned }}</div>
                                    <div class="col-md-6"><strong>Status:</strong> {{ $driver->driver_status }}</div>
                                    <div class="col-md-6"><strong>Hire Date:</strong> {{ $driver->hire_date }}</div>
                                    <div class="col-md-6">
                                        <strong>License Image:</strong><br>
                                        @if($driver->license_image)
                                        <img src="{{ asset('storage/' . $driver->license_image) }}" width="150">
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Medical Cert:</strong><br>
                                        @if($driver->medical_cert_file)
                                        <a href="{{ asset('storage/' . $driver->medical_cert_file) }}"
                                            target="_blank">View</a>
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Drug Test:</strong><br>
                                        @if($driver->drug_test_file)
                                        <a href="{{ asset('storage/' . $driver->drug_test_file) }}"
                                            target="_blank">View</a>
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('drivers.create.driverinfo') }}" class="btn btn-primary">Add New Driver</a>
    </div>

    <!-- Bootstrap JS for modal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @endsection
</x-app-layout>