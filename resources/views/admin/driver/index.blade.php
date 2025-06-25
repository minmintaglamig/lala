@extends('layouts.admin')

@section('title', 'Driver')

@section('content')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

        <a href="{{ route('admin.vehicle.create', $driveruser->id) }}" class="btn btn-primary"
            style="padding: 10px 20px; background-color: #4f46e5; color: white; text-decoration: none; border-radius: 5px;">
            Register Vehicle
        </a>
    </div>
    <strong>ID: </strong> {{ $driverprof->user_id }}<br>
    <strong>NAME: </strong> {{ $driveruser->name }}<br>
    <strong>LICENSE: </strong> {{ $driverprof->license_number }}<br>
    <strong>ROLE: </strong> {{ $driveruser->role }}<br>

@endsection
