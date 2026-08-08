<x-guest-layout>
    <div class="mb-6 flex flex-col items-center">
        <img src="{{ asset('images/logo-yamasy.png') }}" alt="Logo YAMASY" class="w-24 h-24 mb-3">
        <h1 class="text-xl font-bold text-green-700">TU YAMASY</h1>
        <p class="text-sm text-gray-500">Pondok Benda - Tangerang Selatan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-green-600" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700">
                Masuk
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>