@props(['route', 'label'])

@php
    $active = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
    class="flex items-center px-4 py-2 rounded-md text-sm font-medium
           {{ $active ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-orange-500' }}">
    <span class="text-lg mr-2"></span> {{ $label }}
</a>