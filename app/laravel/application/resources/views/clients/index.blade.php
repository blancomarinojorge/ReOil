<x-layout>
    <x-global.top-bar :title="__('Clients')" :breadcrumbs-items="[
        ['label'=>__('Clients')],
    ]">
        @can('create', \App\Models\Client::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('clients.create') }}" icon-name="plus">{{ __('New client') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>Name</x-global.tables.table-head>
                    <x-global.tables.table-head>Email</x-global.tables.table-head>
                    <x-global.tables.table-head>Phone</x-global.tables.table-head>
                    <x-global.tables.table-head>Address</x-global.tables.table-head>
                    <x-global.tables.table-head>Fecha creación</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($clients as $client)
                    <x-global.tables.table-data-row>
                        <x-global.tables.table-data>{{ $client->name }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $client->email }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $client->phone }}</x-global.tables.table-data>
                        <x-global.tables.table-data class="whitespace-nowrap overflow-hidden text-ellipsis max-w-85" title="{{ $client->address }}">{{ $client->address }}</x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $client->created_at }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('clients.show', $client->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                    <x-global.icons.svg-user-data class="w-7"/>
                                </a>
                                @can('delete', $client)
                                    <x-global.tables.delete-button action="{{ route('clients.destroy', $client->id) }}" :value="$client->id"/>
                                @endcan
                            </div>
                        </x-global.tables.table-data>
                    </x-global.tables.table-data-row>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $clients->links() }}
        </div>
    </article>
</x-layout>
