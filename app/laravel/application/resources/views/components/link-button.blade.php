@props(['type' => 'primary', 'iconName' => null])
@php
    $class = "flex items-center py-2 px-5 text-sm transition-colors duration-200 gap-2 ";
    $class .= match ($type){
        "primary" => "text-center bg-primary text-secondary hover:bg-primary/85",
        "secondary" => "hover:bg-tertiary/10"
    };
@endphp

<a {{ $attributes->twMerge(['class' => $class]) }}>
    @if($iconName)
        @component("components.global.icons.svg-{$iconName}",['class'=>'w-6']) @endcomponent <!-- svg component, added just passing the svg name -->
    @endif
    {{ $slot }}
</a>
