@props(['status'])

@php
    $containerClasses = '';
    $circleClasses = '';
    $absoluteCircleClasses = '';
    $textClasses = '';

    switch ($status) {
        case \App\Enums\RouteState::DRAFT:
            $containerClasses = 'bg-draft/30 border border-draft/30';
            $circleClasses = 'bg-draft/50 border-[0.5px] border-draft';
            $absoluteCircleClasses = 'bg-draft';
            $textClasses = 'text-draft';
            break;

        case \App\Enums\RouteState::PENDING:
            $containerClasses = 'bg-pending/30 border border-pending/30';
            $circleClasses = 'bg-pending/50 border-[0.5px] border-pending';
            $absoluteCircleClasses = 'bg-pending';
            $textClasses = 'text-pending';
            break;

        case \App\Enums\RouteState::IN_PROGRESS:
            $containerClasses = 'bg-in-progress/30 border border-in-progress/30';
            $circleClasses = 'bg-in-progress/50 border-[0.5px] border-in-progress';
            $absoluteCircleClasses = 'bg-in-progress';
            $textClasses = 'text-in-progress';
            break;

        case \App\Enums\RouteState::COMPLETED:
            $containerClasses = 'bg-completed/30 border border-completed/30';
            $circleClasses = 'bg-completed/50 border-[0.5px] border-completed';
            $absoluteCircleClasses = 'bg-completed';
            $textClasses = 'text-completed';
            break;

        case \App\Enums\RouteState::CANCELLED:
            $containerClasses = 'bg-cancelled/30 border border-cancelled/30';
            $circleClasses = 'bg-cancelled/50 border-[0.5px] border-cancelled';
            $absoluteCircleClasses = 'bg-cancelled';
            $textClasses = 'text-cancelled';
            break;

        default:
            $containerClasses = 'bg-primary/30 border border-primary/30';
            $circleClasses = 'bg-primary/50 border-[0.5px] border-primary';
            $absoluteCircleClasses = 'bg-primary';
            $textClasses = 'text-primary';
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => "flex gap-2 items-center rounded-sm px-4 py-1 $containerClasses"]) }}>
    <span class="w-3 h-3 rounded-full relative flex items-center justify-center {{ $circleClasses }}">
        <div class="absolute w-full h-full rounded-full animate-state-point {{ $absoluteCircleClasses }}"></div>
    </span>
    <span class="text-xs {{ $textClasses }}">{{ $status->getLabel() }}</span>
</div>

