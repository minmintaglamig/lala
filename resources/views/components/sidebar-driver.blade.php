<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FB9E3A] text-white shadow-lg p-6">
    <h2 class="mb-6 text-xl font-bold">Logistics Menu</h2>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('driver.dashboard') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.dashboard') ? 'font-bold underline' : '' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('driver.profile.show') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.profile.show') ? 'font-bold underline' : '' }}">
                View Profile
            </a>
        </li>
        <li>
            <a href="{{ route('admin.vehicle.index') }}"
            class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.vehicle') ? 'font-bold underline' : '' }}">
            Vehicle
            </a>
        </li>
        <li>
            <a href="{{ route('driver.assignedjobs') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.assignedjobs') ? 'font-bold underline' : '' }}">
                My Assigned Jobs
            </a>
        </li>
        <li>
            <a href="{{ route('driver.location') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.location') ? 'font-bold underline' : '' }}">
                Location Updates
            </a>
        </li>
        <li>
            <a href="{{ route('driver.availability') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.availability') ? 'font-bold underline' : '' }}">
                Set Availability Status
            </a>   
        </li>
        <li>
            <a href="{{ route('driver.history') }}"
                class="block hover:text-[#FCEF91] {{ request()->routeIs('driver.history') ? 'font-bold underline' : '' }}">
                Job History
        </li

</aside>