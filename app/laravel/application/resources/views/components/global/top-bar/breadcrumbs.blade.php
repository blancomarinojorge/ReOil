@props(['items'])

<div class="text-xs text-muted">
    @foreach($items as $item)
        @if($loop->last)
            {{ $item['label'] }}
        @else
            <x-link href="{{ $item['href'] }}">{{ $item['label'] }}</x-link> >
        @endif
    @endforeach
</div>
