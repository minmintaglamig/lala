@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' =>
        'bg-[#FFF4E0] border-gray-300 text-gray-800 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm'
]) }}>
