@props(['variant' => 'primary'])

@php
    $baseClass = "rounded py-2 px-6 font-bold";
    $variants = [
        'primary' => 'bg-primary text-white hover:bg-blue-600', // Electric Blue
        'accent' => 'bg-accent text-white hover:bg-green-600', // Lime Green
        'secondary' => 'bg-secondary text-white hover:bg-orange-600', // Sunset Orange
        'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white', // Outline style
    ];

    $class = $baseClass . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button {{$attributes->merge(['class' => $class])}}>{{$slot}}</button>
