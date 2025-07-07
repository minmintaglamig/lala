@extends('layouts.driver')

@section('title', 'Job History')

@section('content')
<h2 class="text-2xl font-bold mb-4 text-[#EA2F14]">Completed Deliveries</h2>

@if ($jobs->isEmpty())
    <p>No completed jobs yet.</p>
@else
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Client</th>
                <th class="px-4 py-2">Pickup</th>
                <th class="px-4 py-2">Dropoff</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $job->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-2">{{ $job->client_name }}</td>
                    <td class="px-4 py-2">{{ $job->pickup_address }}</td>
                    <td class="px-4 py-2">{{ $job->dropoff_address }}</td>
                    <td class="px-4 py-2 text-green-600">{{ ucfirst($job->delivery_status) }}</td>
                    <td class="px-4 py-2">
                        @if($job->rating)
                            ⭐ {{ $job->rating }}/5 <br>
                            "{{ $job->feedback }}"
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
