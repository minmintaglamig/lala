<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FB9E3A] text-white shadow-lg p-6">
    <h2 class="text-xl font-bold mb-6">Logistics Menu</h2>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('driver.dashboard') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('admin.dashboard') ? 'font-bold underline' : '' }}">
               Dashboard
            </a>
        </li>
    </ul>
</aside>