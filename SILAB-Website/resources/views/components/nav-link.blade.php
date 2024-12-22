@props(['active'])

@php
$classes = ($active ?? false)
? 'p-2 mr-1 text-white bg-unnes-blue/20 text-md rounded-lg hover:text-white hover:bg-unnes-blue/20 dark:text-gray-400 dark:hover:text-white dark:hover:bg-unnes-blue/20 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600'
: 'p-2 mr-1 text-black text-md rounded-lg hover:text-white hover:bg-unnes-blue/20 dark:text-gray-400 dark:hover:text-white dark:hover:bg-unnes-blue/20 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes . 'hover:bg-unnes-blue/10']) }}>
    {{ $slot }}
</a>

