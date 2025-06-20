<x-guest-layout>
    <div class="mb-6 text-center">
        <img src="{{ asset('images/minemang-logo.png') }}" alt="Minemang Logo" class="h-16 mx-auto">
        <h2 class="text-4xl font-extrabold text-orange-600 mt-2">
            Login to Minemang Logistics
        </h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-orange-600" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="bg-orange-500 hover:bg-orange-600">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>