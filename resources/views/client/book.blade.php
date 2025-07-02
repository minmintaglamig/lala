@extends('layouts.client')

@section('title', 'Book')

@section('content')
    <style>
        /* Container */
        form {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        h1 {
            text-align: center;
            color: #EA2F14;
        }

        input[type="text"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            /* Tailwind gray-300 */
            border-radius: 6px;
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #374151;
            /* Tailwind gray-700 */
        }

        .form-group {
            margin-bottom: 16px;
        }

        #map {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 10px;
        }

        .info-display p {
            margin: 6px 0;
        }

        .info-display strong {
            color: #1f2937;
            /* Tailwind gray-800 */
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            background-color: #FB9E3A;
            color: white;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button[type="submit"]:hover {
            background-color: #FCEF91;
            color: #333;
        }
    </style>

    <div>
        <h1 class="text-3xl font-bold text-[#EA2F14] mb-6">Book a Service</h1>

        <form action="{{ route('clientbooking.book.store') }}" method="POST" class="space-y-4">

            @csrf

            <div>
                <div class="hidden">
                    <label for="">CLIENT ID</label>
                    <input type="text" id="client_id" name="client_id" value="{{ auth()->user()->id }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        readonly>
                </div>
                <div class="hidden">
                    <label for="">CLIENT NAME</label>
                    <input type="text" id="client_name" name="client_name" value="{{ auth()->user()->name }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        readonly>
                </div>

                <div class="hidden">
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
