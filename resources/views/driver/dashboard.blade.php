@extends('layouts.driver')

@section('title', 'Dashboard')

@section('content')
    <div class="text-3xl font-bold text-[#EA2F14]">
        Welcome, {{ Auth::user()->name }} ({{ Auth::user()->role }})
    </div>

    <h2 class="mb-4 text-xl font-semibold">Your Current Status</h2>
    <div class="p-4 bg-white rounded shadow">
        <p class="text-gray-700">You are currently logged in as a driver.</p>
        <p class="text-gray-700">Please ensure your profile is up to date.</p>
    </div>
@endsection
