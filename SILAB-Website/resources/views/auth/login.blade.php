<x-guest-layout>
    {{-- <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">--}}
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <!-- Logo/Header -->
            <div>
                <h2 class="mt-2 text-center text-3xl font-extrabold text-gray-900">
                    {{ __('Welcome Back') }}
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    {{ __('Please sign in to your account') }}
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 " :status="session('status')" />

            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700"/>
                    <x-text-input id="email" 
                        class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')"
                        required 
                        autofocus 
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700"/>
                    <x-text-input id="password" 
                        class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" 
                            type="checkbox" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                            name="remember">
                        <span class="ml-2 block text-sm text-gray-900">{{ __('Remember me') }}</span>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a class="font-medium text-indigo-600 hover:text-indigo-500" 
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                </div>

                <div class="">
                    <x-primary-button class="group relative w-full justify-center items-center flex">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    {{--</div> --}}
</x-guest-layout>