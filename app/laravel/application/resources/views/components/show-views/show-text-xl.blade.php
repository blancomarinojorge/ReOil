@props(['label' => null])

<div {{ $attributes(['class' => "flex flex-col gap-2"]) }} >
    @if($label)
        <span>{{ $label }}</span>
    @endif
    <div class="bg-tertiary/5 py-3 px-5 rounded-sm grow h-30 overflow-y-scroll text-wrap">
        {{ $slot }}
    </div>
</div>
