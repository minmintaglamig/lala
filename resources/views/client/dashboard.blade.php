@extends('layouts.client')

@section('title', 'Dashboard')

@section('content')
<div class="text-3xl font-bold text-[#EA2F14] mb-4">
    Welcome, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
</div>

<div class="grid grid-cols-2 gap-6">
    <a href="{{ route('client.history') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-100">
        <h3 class="text-xl font-semibold">📄 View Job History</h3>
        <p>See your past deliveries and download receipts.</p>
    </a>

    <a href="{{ route('client.book') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-100">
        <h3 class="text-xl font-semibold">📦 Book a Delivery</h3>
        <p>Request a new delivery with preferred schedule.</p>
    </a>
</div>
@endsection