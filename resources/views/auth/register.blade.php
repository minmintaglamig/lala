<x-guest-layout>
    <div class="mb-6 text-center">
        <img src="{{ asset('images/minemang-logo.png') }}" alt="Minemang Logo" class="h-16 mx-auto">
        <h2 class="text-2xl font-bold text-orange-600 mt-2">Register to Minemang Logistics</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />
            <select id="role" name="role" required
                class="block mt-1 w-full border-orange-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                <option value="dispatcher" {{ old('role') == 'dispatcher' ? 'selected' : '' }}>Dispatcher</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-orange-600" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-orange-500 hover:bg-orange-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>