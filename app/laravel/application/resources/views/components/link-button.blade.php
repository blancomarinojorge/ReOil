@props(['type' => 'primary'])
@php
    $class = match ($type){
        "primary" => "text-center py-2 px-5 text-sm bg-primary text-secondary hover:bg-primary/85 transition-colors duration-200",
        "secondary" => "py-2 px-5 text-sm hover:bg-tertiary/10 transition-colors duration-200"
    };
@endphp

<a href="{{ route('registration') }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
