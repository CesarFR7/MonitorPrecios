<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <a href="{{route('auth.redirect', ['provider' => 'facebook'])}}"
                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center">
                <i class="fa-brands fa-facebook-f"></i>&nbsp; Iniciar sesión con Facebook
            </a>

            <a href="{{route('auth.redirect', ['provider' => 'google'])}}"
                class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded block text-center">
                <i class="fa-brands fa-google-plus-g margin: 0 200px 0 0 "></i>&nbsp; Iniciar sesión con Google
            </a>
            <a href="{{route('auth.redirect', ['provider' => 'x'])}}"
                class="mt-4 bg-neutral-800 hover:bg-neutral-600 text-white font-bold py-2 px-4 rounded block text-center">
                <i class="fa-brands fa-x-twitter"></i>&nbsp; Iniciar sesión con x.com
            </a>
            <a href="{{route('auth.redirect', ['provider' => 'linkedin-openid'])}}"
                class="mt-4 bg-sky-800 hover:bg-sky-950 text-white font-bold py-2 px-4 rounded block text-center">
                <i class="fa-brands fa-linkedin-in"></i>&nbsp; Iniciar sesión con linkedin
            </a>
            <a href="{{route('auth.redirect', ['provider' => 'github'])}}"
                class="mt-4 bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded block text-center">
                <i class="fa-brands fa-github"></i>&nbsp; Iniciar sesión con github
            </a>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>