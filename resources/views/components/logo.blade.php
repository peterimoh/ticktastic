@props(['size' => 'sm', 'theme' => 'light'])

@php
    $class = implode(' ', [
        'font-bold block',
        $size === 'sm' ? 'text-base' : 'text-2xl',
        $theme === 'light' ? 'text-white' : 'text-black'
    ]);
@endphp

<a {{$attributes->merge(['class' => $class])}}>TickTastic</a>
