<x-layout>
    <x-global.top-bar :title="__('Clients containers')" :breadcrumbs-items="[
        ['label'=>__('Clients containers')],
    ]">
        @can('create', \App\Models\Container::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('containers.create') }}" icon-name="add-user">{{ __('New client container') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>Type</x-global.tables.table-head>
                    <x-global.tables.table-head>Client</x-global.tables.table-head>
                    <x-global.tables.table-head>un code</x-global.tables.table-head>
                    <x-global.tables.table-head>observations</x-global.tables.table-head>
                    <x-global.tables.table-head>creation date</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($containers as $container)
                    <x-global.tables.table-data-row>
                        <x-global.tables.table-data>
                            <x-global.tables.model-link href="{{ route('container_types.show', $container->containerType->id) }}">
                                {{ $container->containerType->name }}
                            </x-global.tables.model-link>
                        </x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <x-global.tables.model-link href="{{ route('clients.show', $container->client->id) }}">
                                {{ $container->client->name }}
                            </x-global.tables.model-link>
                        </x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $container->containerType->un_code }}</x-global.tables.table-data>
                        <x-global.tables.table-data class="whitespace-nowrap overflow-hidden text-ellipsis max-w-85" title="{{ $container->observations }}">{{ $container->observations }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $container->created_at }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('containers.show', $container->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                    <x-global.icons.svg-user-data class="w-7"/>
                                </a>
                                @can('delete', $container)
                                    <x-global.tables.delete-button action="{{ route('containers.destroy', $container->id) }}" :value="$container->id"/>
                                @endcan
                            </div>
                        </x-global.tables.table-data>
                    </x-global.tables.table-data-row>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $containers->links() }}
        </div>
    </article>
</x-layout>
