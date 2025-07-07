@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">

    <div class="col-span-1 lg:col-span-4 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Delivery Map Overview</h2>
        <div id="jobsMap" class="h-80 rounded-lg z-0"></div>
        <p class="text-sm text-gray-500 mt-4">
            <span class="text-blue-600 font-medium">All</span> delivery
        </p>
    </div>
    @include('driver.assignedjobs_components.alljobsjs')

    <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition flex flex-col">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Delivered</h2>
        <table class="text-sm text-left w-full mt-2">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th class="py-2">NAME</th>
                    <th>SCHEDULE TIME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deliveredjobs as $deliveredjob)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $deliveredjob->client_name }}</td>
                        <td>{{ $deliveredjob->scheduled_time }}</td>
                        <td><a href="#" class="text-blue-500 hover:underline">VIEW</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-2 text-center text-gray-400">NO DELIVERED</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p class="text-sm text-gray-500 mt-auto pt-4">This month</p>
    </div>

    <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition flex flex-col">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Cancelled</h2>
        <table class="text-sm text-left w-full mt-2">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th class="py-2">NAME</th>
                    <th>SCHEDULE TIME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cancelledjobs as $cancelledjob)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $cancelledjob->client_name }}</td>
                        <td>{{ $cancelledjob->scheduled_time }}</td>
                        <td><a href="#" class="text-blue-500 hover:underline">VIEW</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-2 text-center text-gray-400">NO CANCELLED</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p class="text-sm text-gray-500 mt-auto pt-4">This month</p>
    </div>

    <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">ALL DELIVERY</h2>
        <div class="w-full max-h-96 overflow-auto rounded-lg border">
            <table class="min-w-max text-sm text-left w-full">
                <thead class="bg-gray-100 sticky top-0 z-10">
                    <tr class="text-gray-600 border-b">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">NAME</th>
                        <th class="px-4 py-2">PICKUP</th>
                        <th class="px-4 py-2">DROPOFF</th>
                        <th class="px-4 py-2">SCHEDULE TIME</th>
                        <th class="px-4 py-2">STATUS</th>
                        <th class="px-4 py-2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alljobs as $alljob)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $alljob->id }}</td>
                            <td class="px-4 py-2">{{ $alljob->client_name }}</td>
                            <td class="px-4 py-2">{{ $alljob->pickup_address }}</td>
                            <td class="px-4 py-2">{{ $alljob->dropoff_address }}</td>
                            <td class="px-4 py-2">{{ $alljob->scheduled_time }}</td>
                            <td class="px-4 py-2">{{ $alljob->delivery_status }}</td>
                            <td class="px-4 py-2">
                                <a href="#" class="text-blue-500 hover:underline">VIEW</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center text-gray-400">NO BOOKING</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">ASSIGNED</h2>
        <div class="w-full max-h-96 overflow-auto rounded-lg border">
            <table class="min-w-max text-sm text-left w-full">
                <thead class="bg-gray-100 sticky top-0 z-10">
                    <tr class="text-gray-600 border-b">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">NAME</th>
                        <th class="px-4 py-2">PICKUP</th>
                        <th class="px-4 py-2">DROPOFF</th>
                        <th class="px-4 py-2">SCHEDULE TIME</th>
                        <th class="px-4 py-2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignedjobs as $assignedjob)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $assignedjob->id }}</td>
                            <td class="px-4 py-2">{{ $assignedjob->client_name }}</td>
                            <td class="px-4 py-2">{{ $assignedjob->pickup_address }}</td>
                            <td class="px-4 py-2">{{ $assignedjob->dropoff_address }}</td>
                            <td class="px-4 py-2">{{ $assignedjob->scheduled_time }}</td>
                            <td class="px-4 py-2">
                                <a href="#" class="text-blue-500 hover:underline">ACCEPT</a>
                                /
                                <a href="#" class="text-blue-500 hover:underline">CANCEL</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center text-gray-400">NO ASSIGNED</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-span-1 lg:col-span-4 bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">In-Progress Jobs Map</h2>
        <div id="inProgressMap" class="h-80 rounded-lg z-0"></div>
        <p class="text-sm text-gray-500 mt-4">
            <span class="text-yellow-600 font-medium">In-progress</span> delivery
        </p>
    </div>
    @include('driver.assignedjobs_components.inprogress')

    <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition flex flex-col">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Notification</h2>
        <table class="text-sm text-left w-full mt-2">
            <thead>
                <tr class="text-gray-600 border-b">
                </tr>
            </thead>
            <tbody>
                @forelse($deliveredjobs as $deliveredjob)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2"></td>
                        <td></td>
                        <td><a href="#" class="text-blue-500 hover:underline">VIEW</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-2 text-center text-gray-400">NO NOTIFICATION</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="col-span-1 bg-white rounded-2xl shadow p-6 hover:shadow-md transition flex flex-col">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">asdasdsad</h2>
        <table class="text-sm text-left w-full mt-2">
            <thead>
                <tr class="text-gray-600 border-b">
                </tr>
            </thead>
            <tbody>
                @forelse($deliveredjobs as $deliveredjob)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2"></td>
                        <td></td>
                        <td><a href="#" class="text-blue-500 hover:underline">VIEW</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-2 text-center text-gray-400">NOasdasd</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
