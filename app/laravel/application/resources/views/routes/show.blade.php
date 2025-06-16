<x-layout>
    <x-global.top-bar :title=" __('Route').' '.$route->id" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id],
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('Route data') }}</x-global.top-bar.page-title>
                    @can('update', $route)
                        <div class="flex items-center">
                            <x-link-button href="{{ route('routes.edit', $route->id) }}" icon-name="edit">{{ __('Edit route data') }}</x-link-button>
                        </div>
                    @endcan
                </div>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <x-forms.field :label="__('driver')" name="driver_id" disabled>
                        <div class="flex gap-3 items-center py-2">
                            <div class="w-8">
                                <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ $route->driver->name }}" alt="Your photo" class="object-cover h-full w-full">
                            </div>
                            {{ $route->driver->name }} {{ $route->driver->surname_1 }} {{ $route->driver->surname_2 }}
                        </div>
                    </x-forms.field>
                    <x-forms.input name="truck_id" :label="__('truck')" disabled :value="$route->truck->license_plate"/>
                    <x-forms.input name="start_date" :label="__('start date')" :value="$route->start_date" disabled/>
                </div>
                <div class="grid">
                    <x-forms.textarea :label="__('description')" name="description" :value="$route->description" class="h-60" disabled/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('Pickups') }}</x-global.top-bar.page-title>
                    @can('update', $route)
                        <div class="flex items-center">
                            <x-link-button href="{{ route('routes.edit', $route->id) }}" icon-name="edit">{{ __('Edit route data') }}</x-link-button>
                        </div>
                    @endcan
                </div>
                <x-forms.separator class="my-2"/>

            </div>
        </div>
    </article>
</x-layout>
