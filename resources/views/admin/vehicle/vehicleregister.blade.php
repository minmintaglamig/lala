<x-guest-layout>
    <form method="POST" action="{{ route('vehicles.store') }}">
        @csrf

        <input type="hidden" name="driver_id" value="{{ $driverId }}">

        <!-- Plate Number -->
        <div class="mt-4">
            <x-input-label for="plate_number" :value="__('Plate Number')" />
            <x-text-input id="plate_number" class="block mt-1 w-full"
                type="text"
                name="plate_number"
                :value="old('plate_number')"
                required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('plate_number')" class="mt-2" />
        </div>

        <!-- Type -->
        <div class="mt-4">
            <x-input-label for="type" :value="__('Vehicle Type')" />
            <x-text-input id="type" class="block mt-1 w-full"
                type="text"
                name="type"
                :value="old('type')"
                required />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- Model -->
        <div class="mt-4">
            <x-input-label for="model" :value="__('Model')" />
            <x-text-input id="model" class="block mt-1 w-full"
                type="text"
                name="model"
                :value="old('model')"
                required autocomplete="off" />
            <x-input-error :messages="$errors->get('model')" class="mt-2" />
        </div>

        <!-- Capacity -->
        <div class="mt-4">
            <x-input-label for="capacity" :value="__('Capacity')" />
            <x-text-input id="capacity" class="block mt-1 w-full"
                type="number"
                name="capacity"
                :value="old('capacity')"
                required />
            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="" disabled selected>Select status</option>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register Vehicle') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
