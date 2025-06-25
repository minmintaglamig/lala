<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" pattern="[0-9]{11}" maxlength="11" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />
            <select id="role" name="role" class="block mt-1 w-full" onchange="showRoleFields()" required>
                <option disabled selected>-- Choose Role --</option>
                <option value="Admin">Admin</option>
                <option value="Driver">Driver</option>
                <option value="Client">Client</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4 hidden" id="admin_fields">
            <x-input-label for="access_code" :value="__('Admin Access Code')" />
            <x-text-input id="access_code" class="block mt-1 w-full" type="text" name="access_code" />
            <x-input-error :messages="$errors->get('access_code')" class="mt-2" />
        </div>

        <div class="mt-4 hidden" id="driver_fields">
            <div>
                <x-input-label for="license_number" :value="__('License Number')" />
                <x-text-input id="license_number" class="block mt-1 w-full" type="text" name="license_number" />
                <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4 hidden" id="client_fields">
            <x-input-label for="client_address" :value="__('Address')" />
            <x-text-input id="client_address" class="block mt-1 w-full" type="text" name="client_address" />
            <x-input-error :messages="$errors->get('client_address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
    function showRoleFields() {
        const role = document.getElementById('role').value;
        document.getElementById('admin_fields').classList.add('hidden');
        document.getElementById('driver_fields').classList.add('hidden');
        document.getElementById('client_fields').classList.add('hidden');

        if (role === 'Admin') document.getElementById('admin_fields').classList.remove('hidden');
        if (role === 'Driver') document.getElementById('driver_fields').classList.remove('hidden');
        if (role === 'Client') document.getElementById('client_fields').classList.remove('hidden');
    }
</script>
</x-guest-layout>