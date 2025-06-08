@props(['label','name','required' => false])

<div {{ $attributes->twMerge(['class' => "flex flex-col gap-2"]) }}>
    @if($label)
        <x-forms.label :$label :$name :$required></x-forms.label>
    @endif

    {{ $slot }}

    <x-forms.error :$name/>
</div>

