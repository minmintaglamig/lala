@extends('layouts.client')

@section('title', 'Book')

@section('content')

    <div>
        <h1 class="text-3xl font-bold text-[#EA2F14] mb-6">Book a Service</h1>

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div>
                <div>
                    <label for="">CLIENT ID</label>
                    <input type="text" id="client_id" name="client_id" value="{{ auth()->user()->id }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        readonly>
                </div>
                <div>
                    <label for="">CLIENT NAME</label>
                    <input type="text" id="client_name" name="client_name" value="{{ auth()->user()->name }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        readonly>
                </div>

                <div>
                    <label for="">CLIENT CONTACT</label>
                    <input type="text" id="client_contact" name="client_contact"
                        value="{{ auth()->user()->phone_number }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        readonly>
                </div>
            </div>

            <div class="space-y-4">
                <input type="text" id="pickup_input" placeholder="Search Pickup Location"
                    value="{{ old('pickup_address') }}" class="p-2 border w-full">
                <input type="text" id="dropoff_input" placeholder="Search Dropoff Location"
                    value="{{ old('dropoff_address') }}" class="p-2 border w-full">

                <select id="vehicle_type" name="vehicle_type" required
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option selected disabled value="">Select a vehicle type</option>
                    <option value="Bicycle">Bicycle</option>
                    <option value="Motorcycle">Motorcycle</option>
                    <option value="Car">Car</option>
                    <option value="Truck">Truck</option>
                    <option value="Van">Van</option>
                    <option value="Bus">Bus</option>
                    <option value="Boat">Boat</option>
                    <option value="Airplane">Airplane</option>
                    <option value="Train">Train</option>
                    <option value="Helicopter">Helicopter</option>
                    <option value="Scooter">Scooter</option>
                </select>

                <div id="map" style="height: 400px;"></div>

                <div class="mt-4 space-y-2 text-gray-800">
                    <p><strong>Pickup Address:</strong> <span id="pickup_display">-</span></p>
                    <p><strong>Dropoff Address:</strong> <span id="dropoff_display">-</span></p>
                    <p><strong>Distance:</strong> <span id="distance_display">-</span> km</p>
                    <p><strong>Price:</strong> <span id="price_display">-</span></p>
                </div>

                <input type="hidden" id="pickup_address" name="pickup_address">
                <input type="hidden" id="dropoff_address" name="dropoff_address">
                <input type="hidden" id="distance_km" name="distance_km">
                <input type="hidden" id="price_php" name="price_php">
            </div>




            <div>
                <label for="package_description" class="block text-sm font-medium text-gray-700">Package Description</label>
                <input type="text" id="package_description" name="package_description" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="scheduled_time" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="datetime-local" id="scheduled_time" name="scheduled_time" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <button type="submit"
                class="px-4 py-2 bg-[#FB9E3A] text-white rounded-md hover:bg-[#FCEF91] transition-colors duration-200">
                Book Now
            </button>
        </form>
    </div>

@endsection
