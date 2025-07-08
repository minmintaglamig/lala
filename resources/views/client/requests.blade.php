@extends('layouts.client')

@section('title', 'My Requests')

@section('content')
    <h1 class="text-2xl font-bold text-[#EA2F14] mb-4">My Delivery Requests</h1>

    @if($jobs->isNotEmpty())
        <table class="w-full bg-white shadow-md rounded-md">
            <thead class="bg-[#FB9E3A] text-white">
                <tr>
                    <th class="px-4 py-2">Pickup</th>
                    <th class="px-4 py-2">Dropoff</th>
                    <th class="px-4 py-2">Package</th>
                    <th class="px-4 py-2">Scheduled</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($jobs as $job)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $job->pickup_address }}</td>
                        <td class="px-4 py-2">{{ $job->dropoff_address }}</td>
                        <td class="px-4 py-2">{{ $job->package_description }}</td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($job->scheduled_time)->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-4 py-2">{{ $job->status ?? 'Pending' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">You have no delivery requests yet.</p>
    @endif
@endsection
