@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'px-4 py-2 block w-full text-center md:text-left font-bold bg-gray-800 text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'px-4 py-2 block w-full text-center md:text-left font-semibold hover:opacity-75 bg-white text-gray-800 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>