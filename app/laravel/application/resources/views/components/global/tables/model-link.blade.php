@props(['iconName' => null])

<a {{ $attributes->twMerge(['class'=>"flex items-center gap-2 bg-secondary-soft py-1 px-3 rounded-sm hover:bg-primary hover:text-secondary transition-colors duration-150"]) }}>
    @if($iconName)
        @component("components.global.icons.svg-{$iconName}",['class'=>'w-6']) @endcomponent <!-- svg component, added just passing the svg name -->
    @endif
    {{ $slot }}
</a>
