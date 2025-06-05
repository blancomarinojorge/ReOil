@props(['label','iconName'])

<a {{ $attributes(["class"=>"flex gap-5 items-center text-tertiary/80 hover:text-tertiary hover:cursor-pointer py-3"]) }} >
    @component("components.global.icons.svg-{$iconName}",['class'=>'w-6']) @endcomponent <!-- svg component, added just passing the svg component name -->
    <span>{{ $label }}</span>
</a>
