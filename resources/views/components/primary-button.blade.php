<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#EA2F14] border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-[#E6521F] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FB9E3A] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>