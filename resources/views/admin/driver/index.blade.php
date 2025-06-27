@extends('layouts.admin')

@section('title', 'DriverProfile')

@section('content')
<div class="container p-4 bg-white rounded shadow">
    <h2 class="mb-4">All Driver Records</h2>

    <form method="GET" action="{{ route('admin.driver.index') }}" class="mb-4 row g-3">
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
            <a href="{{ route('admin.driver.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

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
            @foreach($drivers)
            <tr>
                <td>{{ $driver->name }}</td>
                <td>{{ $driver->phone_number }}</td>
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
                                <div class="col-md-6"><strong>Name:</strong> {{ $driver->name }}</div>
                                <div class="col-md-6"><strong>Contact:</strong> {{ $driver->phone_number }}</div>
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
                                    @endif@extends('layouts.admin')

                                    @section('title', 'DriverProfile')

                                    @section('content')
                                    <div class="container p-4 bg-white rounded shadow">
                                        <h2 class="mb-4">All Driver Records</h2>

                                        {{-- Filter Form --}}
                                        <form method="GET" action="{{ route('admin.driver.index') }}"
                                            class="mb-4 row g-3">
                                            <div class="col-md-4">
                                                <input type="text" name="driver_id" class="form-control"
                                                    placeholder="Filter by Driver ID"
                                                    value="{{ request('driver_id') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Filter by Name" value="{{ request('name') }}">
                                            </div>
                                            <div class="gap-2 col-md-4 d-flex">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                                <a href="{{ route('admin.driver.index') }}"
                                                    class="btn btn-secondary">Reset</a>
                                            </div>
                                        </form>

                                        {{-- Driver Table --}}
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
                                                @foreach($driver as $d)
                                                <tr>
                                                    <td>{{ $d->name }}</td>
                                                    <td>{{ $d->phone_number }}</td>
                                                    <td>{{ $d->license_number }}</td>
                                                    <td>
                                                        @if($d->license_image)
                                                        <img src="{{ asset('storage/' . $d->license_image) }}"
                                                            width="100">
                                                        @else
                                                        N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($d->medical_cert_file)
                                                        <a href="{{ asset('storage/' . $d->medical_cert_file) }}"
                                                            target="_blank">View</a>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($d->drug_test_file)
                                                        <a href="{{ asset('storage/' . $d->drug_test_file) }}"
                                                            target="_blank">View</a>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </td>
                                                    <td>{{ $d->driver_id ?? 'N/A' }}</td>
                                                    <td class="gap-1 d-flex">
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $d->id }}">
                                                            View
                                                        </button>
                                                        <a href="{{ route('admin.driver.edit', $d->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $d->id }}">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>

                                                {{-- View Modal --}}
                                                <div class="modal fade" id="viewModal{{ $d->id }}" tabindex="-1"
                                                    aria-labelledby="viewModalLabel{{ $d->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="text-white modal-header bg-primary">
                                                                <h5 class="modal-title">Driver Details - {{
                                                                    $d->driver_id }}</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6"><strong>Name:</strong> {{
                                                                        $d->name }}</div>
                                                                    <div class="col-md-6"><strong>Contact:</strong> {{
                                                                        $d->phone_number }}</div>
                                                                    <div class="col-md-6"><strong>Email:</strong> {{
                                                                        $d->email }}</div>
                                                                    <div class="col-md-6"><strong>Address:</strong> {{
                                                                        $d->address }}</div>
                                                                    <div class="col-md-6"><strong>DOB:</strong> {{
                                                                        $d->date_of_birth }}</div>
                                                                    <div class="col-md-6"><strong>Gender:</strong> {{
                                                                        $d->gender }}</div>
                                                                    <div class="col-md-6"><strong>Emergency
                                                                            Contact:</strong> {{ $d->emergency_contact
                                                                        }}</div>

                                                                    <div class="col-md-6"><strong>License
                                                                            Number:</strong> {{ $d->license_number }}
                                                                    </div>
                                                                    <div class="col-md-6"><strong>License
                                                                            Expiry:</strong> {{ $d->license_expiry }}
                                                                    </div>
                                                                    <div class="col-md-6"><strong>License Type:</strong>
                                                                        {{ $d->license_type }}</div>
                                                                    <div class="col-md-6"><strong>Additional
                                                                            Permits:</strong> {{ $d->additional_permits
                                                                        }}</div>
                                                                    <div class="col-md-6"><strong>Vehicle
                                                                            Assigned:</strong> {{ $d->vehicle_assigned
                                                                        }}</div>
                                                                    <div class="col-md-6"><strong>Route:</strong> {{
                                                                        $d->route_assigned }}</div>
                                                                    <div class="col-md-6"><strong>Status:</strong> {{
                                                                        $d->driver_status }}</div>
                                                                    <div class="col-md-6"><strong>Hire Date:</strong> {{
                                                                        $d->hire_date }}</div>

                                                                    <div class="col-md-6">
                                                                        <strong>License Image:</strong><br>
                                                                        @if($d->license_image)
                                                                        <img src="{{ asset('storage/' . $d->license_image) }}"
                                                                            width="150">
                                                                        @else
                                                                        N/A
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Medical Cert:</strong><br>
                                                                        @if($d->medical_cert_file)
                                                                        <a href="{{ asset('storage/' . $d->medical_cert_file) }}"
                                                                            target="_blank">View</a>
                                                                        @else
                                                                        N/A
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Drug Test:</strong><br>
                                                                        @if($d->drug_test_file)
                                                                        <a href="{{ asset('storage/' . $d->drug_test_file) }}"
                                                                            target="_blank">View</a>
                                                                        @else
                                                                        N/A
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Delete Confirmation Modal --}}
                                                <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $d->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('admin.driver.destroy', $d->id) }}"
                                                            method="POST" class="modal-content">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="text-white modal-header bg-danger">
                                                                <h5 class="modal-title">Confirm Delete</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete driver <strong>{{
                                                                    $d->name }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{-- Pagination --}}
                                        <div class="mt-3">
                                            {{ $driver->links() }}
                                        </div>

                                        <a href="{{ route('admin.driver.create') }}" class="mt-3 btn btn-primary">Add
                                            New Driver</a>
                                    </div>

                                    <script
                                        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
                                    </script>
                                    @endsection

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
                                    <a href="{{ asset('storage/' . $driver->drug_test_file) }}" target="_blank">View</a>
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

    <a href="{{ route('admin.driver.create') }}" class="btn btn-primary">Add New Driver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection