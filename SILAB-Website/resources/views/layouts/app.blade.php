<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.links')
    </head>
    <body class="font-[Poppins] bg-white">
        <x-navbar-header-user/>
            <main class="bg-white">
                {{ $slot }}
            </main>
    </body>

    @stack('scripts')
</html>