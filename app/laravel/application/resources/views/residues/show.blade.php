<x-layout>
    <x-global.top-bar :title="__('Residue data')" :breadcrumbs-items="[
        ['label'=>__('Residues'), 'href'=>route('residues.index')],
        ['label'=> $residue->name]
     ]">
        @can('update', $residue)
            <div class="flex items-center">
                <x-link-button href="{{ route('residues.edit', $residue->id) }}" icon-name="edit">{{ __('Edit residue') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Residue data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('name')" name="name" class="lg:col-span-2" :value="$residue->name" disabled/>
                    <x-forms.field :label="__('unit')" name="unit" class="w-fit">
                        <x-global.unit-tag :unit="$residue->unit"/>
                    </x-forms.field>
                </div>
            </div>
        </div>
    </article>
</x-layout>
