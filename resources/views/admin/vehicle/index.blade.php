@extends('layouts.admin')

@section('title', 'Vehicles')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2></h2>
        <a href="{{ route('vehicles.create') }}" 
           class="btn btn-primary" 
           style="padding: 10px 20px; background-color: #4f46e5; color: white; text-decoration: none; border-radius: 5px;">
            Register Vehicle
        </a>
    </div>

    
@endsection
