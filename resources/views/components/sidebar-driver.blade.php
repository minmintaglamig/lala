<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FB9E3A] text-white shadow-lg p-6">
    <h2 class="mb-6 text-xl font-bold">Logistics Menu</h2>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('driver.dashboard') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.dashboard') ? 'font-bold underline' : '' }}">
                Dashboard
            </a>
        </li>
        {{-- View Profile --}}
        <li>
            <a href="{{ route('driver.profile.show') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.profile.show') ? 'font-bold underline' : '' }}">
                View Profile
            </a>
        </li>

</aside>