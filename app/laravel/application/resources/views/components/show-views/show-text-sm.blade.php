@props(['label' => null, 'iconName' => null])
<div class="flex flex-col gap-2">
    @if($label)
        <span>{{ $label }}</span>
    @endif
    <div {{ $attributes(['class' => "flex gap-3 bg-tertiary/5 py-3 px-5 rounded-sm grow items-center"]) }}>
        @if($iconName)
            @component("components.global.icons.svg-{$iconName}",['class'=>'w-6']) @endcomponent <!-- svg component, added just passing the svg name -->
        @endif
            {{ $slot }}
    </div>
</div>
