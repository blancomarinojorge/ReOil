<x-layout class="overflow-x-visible">
    <x-global.top-bar :title=" __('Route pickups')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=>__('Pickups'), 'href'=>route('routes.pickups.index', $route->id)],
        ['label'=> $pickup->client->name],
    ]">
    </x-global.top-bar>
    <article class="p-5">
        <div class="flex flex-col xl:flex-row gap-5">
            <x-routes.route-pickups-info :route="$route" :pickup="$pickup"/>
            <section class="p-8 bg-tertiary/5 grow">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('Pickup data') }}</x-global.top-bar.page-title>
                    <div class="flex items-center">
                        <x-link-button href="{{ route('routes.edit', $route->id) }}" icon-name="edit">{{ __('Edit pickup') }}</x-link-button>
                    </div>
                </div>
                <x-forms.separator class="mt-2 mb-4"/>
                <div class="flex justify-end">
                    <x-status-tag :status="$route->state" />
                </div>
                <div class="flex flex-col gap-3 my-10">
                    <h3 class="text-xl">{{ $pickup->client->name }}</h3>
                    <div class="text-sm flex gap-2 items-center">
                        <x-global.icons.svg-location class="w-6"/>
                        <span>{{ $pickup->client->address }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                        <x-show-views.show-text-xl :label="__('delivery note notes')">
                            {{ $pickup->delivery_note_notes }}
                        </x-show-views.show-text-xl>
                        <x-show-views.show-text-xl :label="__('observations')">
                            {{ $pickup->observations }}
                        </x-show-views.show-text-xl>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                        <x-show-views.show-text-sm :label="__('client signature')" :icon-name="$pickup->signature ? 'signature' : null" @endif>
                            @if($pickup->signature)
                                {{ __('client signature') }}
                            @else
                                <span class="text-muted">{{ __('no signature') }}</span>
                            @endif
                        </x-show-views.show-text-sm>
                        <x-show-views.show-text-sm :label="__('started at')">{{ $pickup->start_time }}</x-show-views.show-text-sm>
                        <x-show-views.show-text-sm :label="__('ended at')">{{ $pickup->end_time }}</x-show-views.show-text-sm>
                    </div>
                </div>
            </section>
        </div>
    </article>
</x-layout>
