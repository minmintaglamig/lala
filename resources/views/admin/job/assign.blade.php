@extends('layouts.admin')

@section('title', 'Job')

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #f3f4f6;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #e5e7eb;
            /* Light gray border */
            text-align: left;
        }

        th {
            font-weight: 600;
            color: #111827;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        td a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            margin-right: 10px;
        }

        td a:hover {
            text-decoration: underline;
        }

        .empty-row {
            text-align: center;
            padding: 20px;
            font-weight: bold;
            color: #9ca3af;
        }
    </style>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th>BOOK ID</th>
                <th>DRIVER ID</th>
                <th>DRIVER NAME</th>
                <th>STATUS</th>
                <th>PLATE NUMBER</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($availdriver as $driver)
                @php
                    // Get all vehicles for this driver by matching user_id
                    $driverVehicles = $availvehicle->where('driver_id', $driver->user_id);
                @endphp
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $driver->user_id }}</td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->availability_status }}</td>
                    <td>
                        @if ($driverVehicles->isNotEmpty())
                            @foreach ($driverVehicles as $vehicle)
                                <div style="margin-bottom: 5px;">
                                    <span>{{ $vehicle->plate_number }}</span><br>
                                </div>
                            @endforeach
                        @else
                            <span style="color: gray;">No Available Vehicle</span>
                        @endif
                    <td> <a
                            href="{{ route('job.assignnow.store', ['user_id' => $driver->user_id, 'book_id' => $id, 'vehicle_id' => $vehicle->id]) }}">ASSIGN</a>
                        /
                        <a href="#">CANCEL</a>
                    </td>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-row">NO AVAILABLE DRIVER</td>
                </tr>
            @endforelse
        </tbody>

    </table>
@endsection
