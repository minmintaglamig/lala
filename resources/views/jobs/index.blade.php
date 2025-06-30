@extends('layouts.admin')

@section('title', 'Delivery Jobs')

@section('content')
    <div class="bg-white rounded shadow p-6">
        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                    <th class="px-4 py-2">Job ID</th>
                    <th class="px-4 py-2">Client</th>
                    <th class="px-4 py-2">Driver</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td class="px-4 py-2">{{ $job->id }}</td>
                        <td class="px-4 py-2">{{ $job->client->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $job->driver->name ?? 'Unassigned' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $job->status }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.job.show', $job->id) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ url("/delivery-job/{$job->id}/track") }}" class="ml-2 text-green-600 hover:underline">Track</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
