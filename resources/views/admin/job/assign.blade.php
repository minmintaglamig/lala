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
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($availdriver as  $availdrivers)
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $availdrivers->user_id }}</td>
                    <td>{{ $availdrivers->name }}</td>
                    <td>{{ $availdrivers->availability_status }}</td>
                    <td>
                        <a
                            href="{{ route('job.assignnow.store', ['user_id' => $availdrivers->user_id, 'book_id' => $id]) }}">ASSIGN</a>

                        /
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
