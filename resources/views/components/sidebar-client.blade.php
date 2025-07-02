<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FB9E3A] text-white shadow-lg p-6">
    <h2 class="text-xl font-bold mb-6">Logistics Menu</h2>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('client.dashboard') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('client.dashboard') ? 'font-bold underline' : '' }}">
               Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('client.book') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('client.book') ? 'font-bold underline' : '' }}">
               Book a Delivery
            </a>
        </li>
        <li>
            <a href="{{ route('client.requests') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('client.requests') ? 'font-bold underline' : '' }}">
               View My Requests
            </a>
        </li>
        <li>
            <a href="{{ route('client.track') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('client.track') ? 'font-bold underline' : '' }}">
               Track Delivery Status
            </a>
        </li>
        <li>
            <a href="{{ route('client.history') }}"
               class="block hover:text-[#FCEF91] {{ request()->routeIs('client.history') ? 'font-bold underline' : '' }}">
               Job History & Receipts
            </a>
        </li>
    </ul>
</aside>