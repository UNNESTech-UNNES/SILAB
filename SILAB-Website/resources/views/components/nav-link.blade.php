@props(['active'])

@php
$classes = ($active ?? false)
? 'p-2 mr-1 text-unnes-blue bg-unnes-blue/20 text-md rounded-lg hover:text-unnes-blue hover:bg-unnes-blue/20 dark:text-unnes-blue dark:hover:text-unnes-blue dark:hover:bg-unnes-blue/20 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600'
: 'p-2 mr-1 text-gray-500 text-md rounded-lg hover:text-unnes-blue hover:bg-unnes-blue/20 dark:text-gray-500 dark:hover:text-gray-500 dark:hover:bg-unnes-blue/20 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes . 'hover:bg-unnes-blue/10']) }}>
    {{ $slot }}
</a>

