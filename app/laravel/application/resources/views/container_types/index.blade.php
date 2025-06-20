<x-layout>
    <x-global.top-bar :title="__('Container types')" :breadcrumbs-items="[
        ['label'=>__('Container types')],
    ]">
        @can('create', \App\Models\ContainerType::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('container_types.create') }}" icon-name="plus">{{ __('New container type') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>Name</x-global.tables.table-head>
                    <x-global.tables.table-head>Capacidad</x-global.tables.table-head>
                    <x-global.tables.table-head>Unit</x-global.tables.table-head>
                    <x-global.tables.table-head>Un code</x-global.tables.table-head>
                    <x-global.tables.table-head>Dimensions</x-global.tables.table-head>
                    <x-global.tables.table-head>Fecha creación</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($container_types as $container_type)
                    <x-global.tables.table-data-row>
                        <x-global.tables.table-data>{{ $container_type->name }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $container_type->capacity }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <x-global.unit-tag :unit="$container_type->unit"/>
                        </x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $container_type->un_code }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $container_type->dimensions }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $container_type->created_at }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('container_types.show', $container_type->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                    <x-global.icons.svg-user-data class="w-7"/>
                                </a>
                                @can('delete', $container_type)
                                    <x-global.tables.delete-button action="{{ route('container_types.destroy', $container_type->id) }}" :value="$container_type->id"/>
                                @endcan
                            </div>
                        </x-global.tables.table-data>
                    </x-global.tables.table-data-row>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $container_types->links() }}
        </div>
    </article>
</x-layout>
