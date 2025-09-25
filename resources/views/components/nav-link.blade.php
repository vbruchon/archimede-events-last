@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-4 border-white text-m font-medium leading-5 text-white bg-custom-blue focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-m font-medium leading-5 text-white hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out';

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>