<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FB9E3A] text-white shadow-lg p-6">
    <h2 class="text-xl font-bold mb-6">Logistics Menu</h2>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.dashboard') ? 'font-bold underline' : '' }}">
               Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.vehicle.index') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.vehicle.index') ? 'font-bold underline' : '' }}">
               Vehicles
            </a>
        </li>
        <li>
            <a href="{{ route('admin.job.index') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.job.index') ? 'font-bold underline' : '' }}">
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