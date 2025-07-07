@extends('layouts.client')

@section('title', 'Job History')

@section('content')
<h2 class="text-2xl font-bold mb-4 text-[#EA2F14]">My Completed Deliveries</h2>

@if ($jobs->isEmpty())
    <p>You have no completed deliveries yet.</p>
@else
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Package</th>
                <th class="px-4 py-2">Driver</th>
                <th class="px-4 py-2">Receipt</th>
                <th class="px-4 py-2">Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $job->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-2">{{ $job->package_description }}</td>
                    <td class="px-4 py-2">{{ $job->driver->user->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('client.receipt.download', $job->id) }}" class="text-blue-600 underline">Download</a>
                    </td>
                    <td class="px-4 py-2">
                        @if($job->rating)
                            ⭐ {{ $job->rating }}/5 <br>
                            "{{ $job->feedback }}"
                        @else
                            <form action="{{ route('client.rate', $job->id) }}" method="POST" class="space-y-2">
                                @csrf
                                <input type="number" name="rating" min="1" max="5" required class="border rounded p-1 w-16">
                                <textarea name="feedback" placeholder="Feedback..." class="border rounded w-full p-1"></textarea>
                                <button type="submit" class="bg-[#EA2F14] text-white px-2 py-1 rounded">Submit</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
