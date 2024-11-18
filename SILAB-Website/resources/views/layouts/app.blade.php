<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.links')
    </head>
        <body class="font-[Poppins] bg-white">
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
