<x-layout>
    <x-global.top-bar :title="__('Trucks')" :breadcrumbs-items="[
        ['label'=>__('Trucks')],
    ]">
        @can('create', \App\Models\Truck::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('trucks.create') }}" icon-name="plus">{{ __('New truck') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>{{ __('license plate') }}</x-global.tables.table-head>
                    <x-global.tables.table-head>{{ __('Name') }}</x-global.tables.table-head>
                    <x-global.tables.table-head>{{ __('creation date') }}</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($trucks as $truck)
                    <x-global.tables.table-data-row>
                        <x-global.tables.table-data>{{ $truck->license_plate }}</x-global.tables.table-data>
                        <x-global.tables.table-data class="{{ $truck->name ? '' : 'text-muted' }}">{{ $truck->name ?? 'vacío' }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $truck->created_at }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('trucks.show', $truck->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                    <x-global.icons.svg-lens class="w-7"/>
                                </a>
                                @can('delete', $truck)
                                    <x-global.tables.delete-button action="{{ route('trucks.destroy', $truck->id) }}" :value="$truck->id"/>
                                @endcan
                            </div>
                        </x-global.tables.table-data>
                    </x-global.tables.table-data-row>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $trucks->links() }}
        </div>
    </article>
</x-layout>
