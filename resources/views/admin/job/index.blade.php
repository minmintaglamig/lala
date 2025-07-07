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

        /*  */
    </style>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th>ID</th>
                <th>Driver_ID</th>
                <th>Vehicle_ID</th>
                <th>PICKUP</th>
                <th>DROPOFF</th>
                <th>DESCRIPTION</th>
                <th>TIME</th>
                <th>STATUS</th>
                <th>CLIENT NAME</th>
                <th>CLIENT CONTACT</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($book as $books)
                <tr>
                    <td>{{ $books->id }}</td>
                    <td>{{ $books->driver_id }}</td>
                    <td>{{ $books->vehicle_id }}</td>
                    <td>{{ $books->pickup_address }}</td>
                    <td>{{ $books->dropoff_address }}</td>
                    <td>{{ $books->package_description }}</td>
                    <td>{{ $books->scheduled_time }}</td>
                    <td>{{ $books->delivery_status }}</td>
                    <td>{{ $books->client_name }}</td>
                    <td>{{ $books->client_contact }}</td>
                    <td>{{ $books->price }}</td>
                    <td>
                        <a href="{{ route('job.driver.assign', $books->id) }}">ASSIGN</a>
                        <a href="#">CANCEL</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">NO BOOKING</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
