<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.links')
    </head>
    <body class="font-['Poppins'] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
            <div>
                <a href="/">
                    <img src="{{ asset('assets/Logo Silab.svg') }}" alt="Logo Silab" class="mx-auto h-20">
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 overflow-hidden sm:rounded-lg shadow-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
