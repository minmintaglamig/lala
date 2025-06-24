<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-white hover:bg-[#FB9E3A] focus:bg-[#FB9E3A] transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>
