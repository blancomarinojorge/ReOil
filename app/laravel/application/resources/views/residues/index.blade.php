<x-layout>
    <x-global.top-bar :title="__('Residues')" :breadcrumbs-items="[
        ['label'=>__('Residues')],
    ]">
        @can('create', \App\Models\Residue::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('residues.create') }}" icon-name="add-user">{{ __('New residue') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>Name</x-global.tables.table-head>
                    <x-global.tables.table-head>Unit</x-global.tables.table-head>
                    <x-global.tables.table-head>Fecha creación</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($residues as $residue)
                    <x-global.tables.table-data-row>
                        <x-global.tables.table-data>{{ $residue->name }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <x-global.unit-tag :unit="$residue->unit"/>
                        </x-global.tables.table-data>
                        <x-global.tables.table-data>{{ $residue->created_at }}</x-global.tables.table-data>
                        <x-global.tables.table-data>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('residues.show', $residue->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                    <x-global.icons.svg-user-data class="w-7"/>
                                </a>
                                @can('delete', $residue)
                                    <x-global.tables.delete-button action="{{ route('residues.destroy', $residue->id) }}" :value="$residue->id"/>
                                @endcan
                            </div>
                        </x-global.tables.table-data>
                    </x-global.tables.table-data-row>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $residues->links() }}
        </div>
    </article>
</x-layout>
