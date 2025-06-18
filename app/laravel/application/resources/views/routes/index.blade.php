<x-layout>
    <x-global.top-bar :title="__('Routes')" :breadcrumbs-items="[
        ['label'=>__('Routes')],
    ]">
        @can('create', \App\Models\Route::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('routes.create') }}" icon-name="add-user">{{ __('New route') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>Driver</x-global.tables.table-head>
                    <x-global.tables.table-head>Stops</x-global.tables.table-head>
                    <x-global.tables.table-head>Truck</x-global.tables.table-head>
                    <x-global.tables.table-head>State</x-global.tables.table-head>
                    <x-global.tables.table-head>Date</x-global.tables.table-head>
                    <x-global.tables.table-head>Fecha creación</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($routes as $route)
                    <x-global.tables.table-data-row>
                        <x-global.tables.table-data>
                            <div class="flex gap-3 items-center">
                                <div class="w-8">
                                    <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ $route->driver->name }}" alt="Your photo" class="object-cover h-full w-full">
                                </div>
                                {{ $route->driver->name }} {{ $route->driver->surname_1 }} {{ $route->driver->surname_2 }}
                            </div>
                        </x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <x-global.tables.model-link href="{{ route('routes.pickups.index', $route->id) }}" icon-name="location">
                                @choice('messages.x_clients', $route->pickups_count, ['count' => $route->pickups_count])
                            </x-global.tables.model-link>
                        </x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $route->truck->license_plate }}</x-global.tables.table-data>
                        <x-global.tables.table-data><x-status-tag :status="$route->state" /></x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $route->start_date }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $route->created_at }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('routes.show', $route->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                    <x-global.icons.svg-user-data class="w-7"/>
                                </a>
                                @can('delete', $route)
                                    <x-global.tables.delete-button action="{{ route('routes.destroy', $route->id) }}" :value="$route->id"/>
                                @endcan
                            </div>
                        </x-global.tables.table-data>
                    </x-global.tables.table-data-row>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $routes->links() }}
        </div>
    </article>
</x-layout>
