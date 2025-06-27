@extends('layouts.client')

@section('title', 'Dashboard')

@section('content')
<div class="text-3xl font-bold text-[#EA2F14]">
    Welcome, {{ Auth::user()->name }} ({{ Auth::user()->role }})
</div>
@endsection