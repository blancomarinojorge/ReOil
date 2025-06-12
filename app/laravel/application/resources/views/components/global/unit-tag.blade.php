@props(['unit'])

@php
    $svg = match ($unit){
        \App\Enums\Unit::Liters => "unit-liters",
        \App\Enums\Unit::Kilograms => "unit-kilograms",
        \App\Enums\Unit::Pieces => "unit-piece"
    }
@endphp


<span {{ $attributes->twMerge(['class'=>"inline-flex gap-2 items-center py-1 px-3 bg-secondary-soft rounded-md text-sm"]) }}>
   @if($svg)
        @component("components.global.icons.svg-{$svg}",['class'=>'w-5']) @endcomponent <!-- svg component, added just passing the svg name -->
    @endif
    {{ __($unit->getLabel()) }}
</span>
