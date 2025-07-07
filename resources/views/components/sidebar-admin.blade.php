<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FB9E3A] text-white shadow-lg p-6">
    <h2 class="mb-6 text-xl font-bold">Logistics Menu</h2>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.dashboard') ? 'font-bold underline' : '' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.driver.index') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.driver.index') ? 'font-bold underline' : '' }}">
                Drivers Profile
            </a>
        </li>
        <li>
            <a href="{{ route('vehicleniash.vehicleniash.index') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('vehicleniash.vehicleniash.index') ? 'font-bold underline' : '' }}">
                Vehicles
            </a>
        </li>
        <li>
            <a href="{{ route('job.job.index') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('job.job.index') ? 'font-bold underline' : '' }}">
                Jobs
            </a>
        </li>
        <li>
            <a href="{{ route('admin.location.index') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.location.index') ? 'font-bold underline' : '' }}">
                Location Updates
            </a>
        </li>
    </ul>
</aside>